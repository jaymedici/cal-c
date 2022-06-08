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


#### **TASKS QUEUE:**
- ***Bug:*** A test for checking successful assignment of sites and managers is failing.
- ***Bug:*** A test that checks if users are assigned to a site after site creation is also failing.
- Start working on Screening Appointments
- Add Reminder Emails
- Add Notification alerts
- Add reminder email preferences page
- Rewrite adding users and sites to a projects
- Add project-specific roles
- Add check to ensure a user is assigned to a project only once
- Add breadcrumbs on pages
- Add Site Filter on view appointments page

