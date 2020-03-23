<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;


class MaintenanceShell extends Shell
{
//sudo crontab -u www-data -e
// /var/www/sites/boatndive/bin/cake Maintenance
    public function initialize()
    {
        parent::initialize();
        //$this->loadModel('');
        Time::$defaultLocale = 'en_AU';
	    Time::setToStringFormat('dd/MM/yyyy');
    }
    
    public function main() {
        $this->updateStatus();
        
        $this->lockTripPersonnel();
    }
    
    private function lockTripPersonnel(){
        $this->out('lockTripPersonnel');
        $connection = ConnectionManager::get('default');
        
        $this->loadModel('Trips');
        $result = $this->Trips->lockPersonnel();
        
        $this->out($result);
        
    }
    
    private function updateStatus(){
        $this->out('UpdateStatus');
        $connection = ConnectionManager::get('default');
                
        $query = <<<EOD
#First clear certs
UPDATE certifications SET `status` = 4, status_date = NOW();

#not yet validated
UPDATE certifications SET `status` = 2, status_date = NOW() WHERE active = 1 AND (valid = 0 OR valid IS NULL);

#Is Good
UPDATE certifications SET `status` = 1, status_date = NOW() WHERE 
active = 1 AND valid = 1 AND (
expires IS NULL OR expires > date_add(now(), interval 1 month));

#Less than a month flag
UPDATE certifications SET `status` = 2, status_date = NOW() WHERE 
active = 1 AND valid = 1 AND 
expires < date_add(now(), interval 1 month) AND
expires > now();

#expired
UPDATE certifications SET `status` = 3, status_date = NOW() WHERE 
active = 1 AND valid =1 AND expires < now();

## Equipment
#update equipment dates
UPDATE equipment e
LEFT JOIN
(
select el.equipment_id, min(el.`alert_date`) as min_date
from equipment_logs el
where el.active = 1  AND el.alert_date IS NOT NULL
group by el.equipment_id
) as newdate on newdate.equipment_id = e.id
SET e.next_alert = newdate.min_date
where e.active = 1;

#reset statuses
UPDATE equipment SET `status` = 4, alert_status = 4 ,status_date = NOW();

#Is Empty
UPDATE equipment SET `status` = 0, status_date = NOW() WHERE 
active = 1 AND next_service IS NULL;
UPDATE equipment SET alert_status = 0 WHERE active = 1 AND next_alert IS NULL;

#Is Good
UPDATE equipment SET `status` = 1, status_date = NOW() WHERE 
active = 1 AND next_service > date_add(now(), interval 1 month);
UPDATE equipment SET alert_status = 1 WHERE 
active = 1 AND next_alert > date_add(now(), interval 1 month);

#Less than a month
UPDATE equipment SET `status` = 2, status_date = NOW() WHERE 
active = 1 AND  
next_service < date_add(now(), interval 1 month) AND
next_service > now();
UPDATE equipment SET alert_status = 2 WHERE 
active = 1 AND  
next_alert < date_add(now(), interval 1 month) AND
next_alert > now();

#expired
UPDATE equipment SET `status` = 3, status_date = NOW() WHERE 
active = 1 AND next_service < now();
UPDATE equipment SET alert_status = 3, status_date = NOW() WHERE 
active = 1 AND next_alert < now();

#update user tables
INSERT INTO user_statuses (user_id, `status`, status_date, `type`, modified) 
select * from (
select c.user_id, max(c.`status`) as max_status, min(c.status_date) as min_date, 'Certifications' ,NOW()
from certifications c
where c.active = 1  AND c.status_date IS NOT NULL
group by c.user_id
) as s  where s.user_id IS NOT NULL
ON DUPLICATE KEY UPDATE `status`= s.max_status, status_date= s.min_date, modified=NOW();

#update user tables
INSERT INTO user_statuses (user_id, `status`, status_date, `type`, modified) 
select * from (
select c.user_id, max(c.`status`) as max_status, min(c.status_date) as min_date, 'Equipment' ,NOW()
from equipment c
where c.active = 1 AND c.status_date IS NOT NULL
group by c.user_id
) as s  where s.user_id IS NOT NULL
ON DUPLICATE KEY UPDATE `status`= s.max_status, status_date= s.min_date, modified=NOW();

INSERT INTO user_statuses (user_id, `status`, status_date, `type`, modified) 
select * from (
select c.user_id, max(c.cert_status) as max_status, min(c.cert_status_date) as min_date, 'Registers' ,NOW()
from registers c
where c.active = 1 AND c.`status` = 'Registered' AND c.cert_status_date IS NOT NULL
group by c.user_id
) as s where s.user_id IS NOT NULL
ON DUPLICATE KEY UPDATE `status`= s.max_status, status_date= s.min_date, modified=NOW();
EOD;
        
        try { 
            $connection->execute($query);
        }catch (Exception $e) { 
            $this->out('Error: '.$e->getMessage());
        }
        
        //TODO: Work out if need to run bassed on expiry dates and modified dates
        //Update status on all registers
        $this->loadModel('Registers');
        $this->Registers->processAll();
        
    }    
}
