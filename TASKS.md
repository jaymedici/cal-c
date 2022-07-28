# Tasks Overview

### The Purpose of this document is to provide a quick overview of the features/tasks currently being worked on, or tasks that have been completed.

#### **28/04/2022:**
- Creating a 'view Appointments' page - **DONE**
- Creating a livewire component for viewing appointments - **DONE**
- Creating a factory for Appointments **DONE**
- Creating a factory for Participant Visits - **DONE**
- Creating foreign keys for tables: appointments, participant_visits, project_sites, screening, user_projects, user_sites, and visit_settings - **DONE**


#### **29/04/2022:**
- Continuing with factory creation for Appointments - **DONE**
- Creating a factory for Screening
- Continuing work on the view appointments page:
    - Adding Pagination - **DONE**
- Adding Search functionality - **DONE**
    - Adding Project Filter
    - Adding Site Filter
    - Adding Date Filter
- Sorting out a minor bug caused by the insertion and viewing of the first participant's visit:
    - How to display the first visit
    - On enrolment, first visit is automatically marked as completed
- Writing Tests for Enrolling Participants **ON THIS**
- Refactoring storeParticipant method on ParticipantVisitsController - **DONE**


#### **02/05/2022:**
- Continuing with tests for Enrolling Participants
- Refactoring StoreParticipant method on ParticipantVisitsController - **DONE**


#### **03/05/2022:**
- Continuing with tests for Enrolling Participants - **Partially Done**
- Continuing Refactoring StoreParticipant method on ParticipantVisitsController - **DONE**
- Check all places where a checkForDuplicate function has been used. it seems to be bypassed (Check handling of StoreParticipant). Also, Maybe try to use unique instead - **DONE**
- Creating an artisan command for generating test participant visit schedules - **DONE**
- Working on the first visit during enrolment issue - **DONE**


#### **04/05/2022:**
- Working on the EnrolParticipantTest to factor in the mark_first_visit_complete added variable - **DONE**
- Creating an artisan command for generating dummy appointments - **DONE**
- Adding Project Filter on view appointments page - **DONE**
- Refactoring Screening controller
    - Refactoring store method - **DONE**
- Creating a Test for Screening Patient functionality - **DONE**
- Working on including site on screen patient form


#### **05/05/2022:**
- Adding a view for Screened Patients


#### **24/05/2022:**
- Sorting out a strange issue with the 'add visits' page. - **DONE**
- Adding a Change Password feature. - **DONE**


#### **07/06/2022:**
- Adding pagination for Assigned Users on Project.  - **DONE**
- Commenting out adding users and sites to projects temporarily. - **DONE**


#### **08/06/2022:**
- Adding a view for Screened Participants. - **DONE**


#### **08/06/2022:**
- Screening site automatically setting itself as Mbeya. PS: Try to pick site based on the assigned site of the User. - **DONE**
- Add the quick stats on project dashboard.
- Add Users to Site function. - **DONE**
- Add View Users for each site. - **DONE**
- Remove visit link for screening visits on Appointments this week. 


#### **05/07/2022:**
- Add pagination on 'Appointments This Week' - **DONE**
- Filter Appointments this week by assigned site - **DONE**
- Filter Screening index records by assigned site - **DONE**


#### **08/07/2022:**
- Add a visit name or screening label for Appointments loaded on the Calendar. - **DONE**
- Add a screening label & Outcome filter on Screening Index. - **DONE**
- Add Screening record Editing. - **DONE**
- Add Screening record Deletion


#### **11/07/2022:**
- Filter the number of site names displaye on Participant enrollment page. - **DONE**
- Filter the number of participants displated on enrolment page. - **DONE**
- Add a participant search on enrolment page. - **DONE**


#### **13/07/2022:**
- Add visit name on Scheduled visits (Home). - **DONE**
- Add All visits link below Scheduled Visits (Home). - **PARTIALLY DONE**


#### **14/07/2022:**
- Add participant id search on All Participant visits page. - **DONE**
- Add visit status filter on All Participant visits page. - **DONE**


#### **16/07/2022:**
- Add Appointments on Main Menu - **DONE**
- Add appointments manually: - **DONE**
    - Test result pickup  - **DONE**
    - Screening - **DONE**
    - Visits: 
        - Scheduled - **DONE**
        - Unscheduled - **DONE**
- Add Edit Appointment on Appointments page
- Add visit_type column on appointments table - **DONE**
- populate visit_type on previous entries 
- Add Awaiting results as an outcome on Screening Form
- getProjects on viewAppointments is unnecessarily complicated
- Add Clear Filter on Appointments page
- Add a validation that checks if the selected site is assigned to the selected project when storing a manually created Appointment


#### **25/07/2022:**
- Rework the Screen New Patient form - **DONE** 
- Screen New participant should not ask for project as it pull it automatically - **DONE**
- A foreign key migration is failing on the Live Server - **DONE** 
- Missed Visits not being flagged - **DONE** 


#### **26/07/2022:**
- Add Study Arm Functionality
    - Migration, Model  - **DONE** 
- Add Enrolled Participant Model - **DONE** 
- Add study arms to scheduled visits (Home) using parenthesis around participant id. - **DONE**
- Add Study Arm on All Visits. - **DONE**
- Create an enrolled participant entry when enrolling a participant  - **DONE**
- Choose study arm when enrolling a participant  - **DONE**


#### **27/07/2022:**
- Add Study Arm on weekly Appointments - **DONE**
- Add Study Arm on All Appointments - **DONE**
- On Project View -> Add Quick links link to "Enrolled Participants"
- On Enrolled Participants page. Show participants, first visit date, Study Arm
	- Add link to view participant
	- Change Arm link
- Fix a Bug on the view Appointments page. - **DONE**
- Add Edit visit Already
- Add set Appointment on all Visits


#### **28/07/2022:**
- Add Search for Participant ID on Scheduled visits - **DONE**



#### **BACKLOG:**
- ***Bug:*** A test for checking successful assignment of sites and managers is failing.
- ***Bug:*** A test that checks if users are assigned to a site after site creation is also failing.
- Add Reminder Emails
- Add Notification alerts
- Add reminder email preferences page
- Add project-specific roles
- Add check to ensure a user is assigned to a project only once
- Add breadcrumbs on pages
- Add Site Filter on view appointments page

- FILTER PARTICIPANT VISITS BY SITE ASSIGNED
- Limit Screening record editing and deletion to Study Secretaries

- Add ability to edit visit status.
    - Create form
    - Write backend logic

- STUDY ARM Functionality:
- When creating a project, a user should select if the project will have 'study arms'

- Change 'Enrol' on Screening Outcome to 'Eligible for Enrolment'
    - Add subsequent qn below: Which Arm?
- On Enrolment add Arm to which the participant should be enrolled

- Remove entries on scheduled visits and weekly appointments for tasks that have either been marked as Complete or Missed.

- Add link to show visits on Enrolled Participants for each participant
- Add first visit date column on Enrolled Participants

