# Project Notes

*Note: Add nalang kayo kung ano gusto nyong mga defaults natin like naming convetion and etc.*


# !! General Route Methods !!

* index - show all data
* show - show a single data
* create - show a form / to input a data
* store - store data in database
* edit - show form to edit a data
* update - update a data
* destroy - delete a data 

*Note: custom route name is allowed, but try to lessen its usage and make an alias for it or comment what it do.*



# !! MAIL SETUP !!

* Use Mailtrap for fake smtp server.

* Configure env file to connect to your fake smtp server.

* edit your mail_from_address to this:
`MAIL_FROM_ADDRESS="saooecs-noreply@apc.edu.ph"`

*Note: Upto 50 email lang ata yung mailtrap per account, so use it wisely!*

# !! Views Naming Convention !!

* 1. Folder Name - may underscore sa unahan yung mga folder ng user para sa mga tabs.
* 2. File Name - Use kebab-case.
* 3. "_users" Folder - andito yung mga blade na accessible sa mga approvers at stud org na tabs.


# !! DB NAME !! 

`DB_NAME = saooecs`

*Note: pwede kahit ano. local server naman to eh hehe. Pero yan standard name natin.*

# General Sprints

1. Sprint 1: Authentication/Authorization - Login/Breeze/Define Roles
    - Roles:
        | Role Code | Group | Role | 
        |--|--|--|
        | 1 | Student | President |
        | 2 | Student | secretary |
        | 3 | Student | member |
        | 4 | Faculty | Adviser |
        | 5 | Faculty | SAO Head |
        | 6 | Faculty | AS |
        | 7 | Faculty | Finance |
        | 8 | Admin | Admin |

2. Sprint 2: Assign Roles 
    - Add Role - ADV, Pres, Sec
    - View role - ALL
    - Update Role- ADV, Pres, Sec
    - Remove Role- ADV, Pres, Sec

3. Sprint 3: Form Submission
    - Create form
    - Update form
    - Submit form (submit to next approver)
    - Delete form
    - View form
    - Download form
    - Email

4. Sprint 4: Form Approval
    - View submitted form
    - Approve submitted form
    - Deny submitted form + feedback
    - Email

5. Sprint 5: Chart / Calendar
