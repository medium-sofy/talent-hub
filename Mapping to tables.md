Here's the database schema mapped to your requirements in the requested format:

##### Note: Need to modify job-listing table
## Users

id (PK)  
f_name
l_name
email  
password  
role (employer/candidate/admin)  
profile_picture_url  
created_at  
updated_at

## Employers

id (PK)  
user_id (FK Users)  
company_name  
company_logo_url  
website  
description  
created_at  
updated_at

## Candidates

id (PK)  
user_id (FK Users)  
resume_url  
linkedin_profile  
phone_number  
created_at  
updated_at

## Categories

id (PK)  
name (programming/management/etc)  
created_at  
updated_at
## Technologies

id (PK)  
name  
created_at  
updated_at
## Skills

id (PK)
name
created_at
updated_at
## JobListings

id (PK)  
employer_id (FK Employers)  
title  
description  
requirements  (FK Requirements)
benefits  (FK Benefits)
location  (FK Locations)
category_id (FK JobCategories)  
workplace (use enums)(remote/onsite/hybrid)  
job_type (use enums)(Full-time, Part-time, freelance)
upper_salary
lower_salary
application_deadline  
is_approved (boolean)  
created_at  
updated_at

## Job_listing_Requirements
id (PK)
job_listing_id(FK) UNIQUE
requirement UNIQUE

## Job_listing_Skills
id (PK)
job_listing_id(FK) UNIQUE
skill (FK) UNIQUE
## job_listing_Images

id (PK)
job_listing_id(FK Job_listings) UNIQUE
path UNIQUE
created_at
updated_at
## JobListingTechnology

id(PK)
job_listing_id (FK JobListings) UNIQUE
technology_id (FK Technologies) UNIQUE

## Applications

id (PK)  
job_listing_id (FK JobListings) UNIQUE
candidate_id (FK Candidates) UNIQUE
status (pending/accepted/rejected)  
contact_email  
contact_phone  
resume_url  
created_at  
updated_at

## Comments

id (PK)  
user_id (FK Users)  
commentable_id (polymorphic)  
commentable_type (JobListing/other)  
content  
created_at  
updated_at

## Notifications

id (PK)  
user_id (FK Users)  
message  
is_read (boolean)  
created_at  
updated_at

## Analytics

id (PK)  
job_listing_id (FK JobListings)  
views_count  
applications_count  
created_at  
updated_at