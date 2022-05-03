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
- Creating an artisan command for generatin dummy appointments


#### **TASKS QUEUE:**
- Properly handle First Visit record when generating participant visit schedule. Automatically marking it as complete is not so smart
- A test for checking successful assignment of sites and managers is failing.
- A test that checks if users are assigned to a site after site creation is also failing.
