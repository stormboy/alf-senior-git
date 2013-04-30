<% control StaffMember %>BEGIN:VCARD
VERSION:2.1
N:{$LastName};{$FirstName}
FN:$Name
ORG:Alfred Senior
TITLE:$Title
PHOTO;JPG:$ProfilePhoto.URL
TEL;WORK;VOICE:$Phone1
TEL;HOME;VOICE:$Phone2
ADR;WORK:;;55 Commercial Road;Melbourne;VIC;3004;Australia
EMAIL;PREF;INTERNET:$Email
REV:20130424T195243Z
END:VCARD<% end_control %>