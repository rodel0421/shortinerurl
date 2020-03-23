<h2 class="title">Campus Mailing Lists, Getting Outlook to recognize 3rd Party Calendar Events</h2>
<div style="float:right;text-align:right;background-color:#F6F4F0;padding:1px;border:0px solid #e5e5e5;border-radius:2px;"></div>
<div id="doc-summary">
    <p>This document describes the expected behavior of calendar events sent a Campus Mailing List from Outlook, Gmail, Yahoo and Hotmail.</p></div>
<p><span style="color: rgb(0,0,0);">There is a registry key a user can set to make Outlook recognize 3rd party / unknown calendar events. &nbsp; 
<span style="color: rgb(0,0,0);">When the key is set to 1 the Outlook will attempt to interpret the 3rd party calendar format so you can accept or reject it. &nbsp;&nbsp;
<span style="color: rgb(0,0,0);">By default the key doesn't exist so when the key</span>
<span style="color: rgb(0,0,0);">&nbsp;is set to 0 Outlook will not accept meetings sent by 3rd parties. &nbsp;</span>
<span style="color: rgb(0,0,0);">&nbsp;</span></span></span></p><p><span style="color: rgb(0,0,0);">
        <span style="color: rgb(0,0,0);">
        <span style="color: rgb(0,0,0);">---------------------------------------------------------------------------------------------------------------------</span></span>
    </span></p>
    <pre>Key: HKEY_CURRENT_USER\Software\Microsoft\Office\&lt;version&gt;\Options\Calendar <br />
Value name: ExtractOrganizedMeetings <br />Value type: REG_DWORD <br />Value: 1</pre>
    <p>---------------------------------------------------------------------------------------------------------------------</p>
    <p>Below are appropriate registry setting files for the different versions of Outlook. &nbsp;Simply 
        download the *.reg file for your version of Outlook, double click it and Windows will create the key and enable the <strong>
            <em>ExtractOrganizedMeetings</em> </strong>feature.</p>
    <ul>
        <li><?= $this->Html->link('ExtractOrganizedMeeting-Outlook-2016.reg','/libs/fix/ExtractOrganizedMeeting-Outlook-2016.reg',['download'=>'ExtractOrganizedMeeting-Outlook-2016.reg'])?></li>
        <li><?= $this->Html->link('ExtractOrganizedMeeting-Outlook-2013.reg','/libs/fix/ExtractOrganizedMeeting-Outlook-2013.reg',['download'=>'ExtractOrganizedMeeting-Outlook-2013.reg'])?></li>
        <li><?= $this->Html->link('ExtractOrganizedMeeting-Outlook-2010.reg','/libs/fix/ExtractOrganizedMeeting-Outlook-2010.reg',['download'=>'ExtractOrganizedMeeting-Outlook-2010.reg'])?></li>
        <li><?= $this->Html->link('ExtractOrganizedMeeting-Outlook-2007.reg','/libs/fix/ExtractOrganizedMeeting-Outlook-2007.reg',['download'=>'ExtractOrganizedMeeting-Outlook-2007.reg'])?></li>
    </ul>
    <p>There are <a href="https://support.microsoft.com/en-us/help/2646698/outlook-issues-that-occur-when-you-use-the-extractorganizedmeetings-registry-value"> known side effects of ExtractOrganizedMeetings key</a>. 
                &nbsp;These include:</p>
<ol><li>When booking a room, the meeting is not automatically declined when your 
time conflicts with another meeting already scheduled. &nbsp;Double click on 
the room to see its availability.</li>
<li>A meeting created by a delegate appears on the delegate's calendar even-though the delegate was not invited.</li>
<li>Updates to a single instance of a reoccurring meeting do not get reflected on the delegate's calendar.</li></ol>
