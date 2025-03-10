<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//  Job Listings Page (Shows Basic Info of the job )
Route::get('/jobs', function () {
    $jobs = [
        [
            'id' => 1,
            'title' => 'Software Engineer',
            'company' => 'ABC Tech',
            'location' => 'Cairo, Egypt',
            'job_type' => 'Full-time',
            'work_type' => 'On-site',
            'category' => 'Programming',
            'company_logo' => 'abc_tech_logo.png',
            'posted_at' => '5 days ago',
            'experience' => 'Mid-Level',
        ],
        [
            'id' => 2,
            'title' => 'Project Manager',
            'company' => 'XYZ Solutions',
            'location' => 'Remote',
            'job_type' => 'Part-time',
            'work_type' => 'Remote',
            'category' => 'Management',
            'company_logo' => 'xyz_solutions_logo.png',
            'posted_at' => '3 days ago',
            'experience' => 'entry-Level',
        ],
        [
            'id' => 3,
            'title' => 'Data Analyst',
            'company' => 'Data Corp',
            'location' => 'Alexandria, Egypt',
            'job_type' => 'Internship',
            'work_type' => 'Hybrid',
            'category' => 'Data Analysis',
            'company_logo' => 'data_corp_logo.png',
            'posted_at' => '1 day ago',
            'experience' => 'senior',
        ],
        [
            'id' => 4,
            'title' => 'Wordpress developer',
            'company' => 'Ak Tech',
            'location' => 'Cairo, Egypt',
            'job_type' => 'Internship',
            'work_type' => 'Hybrid',
            'category' => 'Data Analysis',
            'company_logo' => 'wp.png',
            'posted_at' => '1 day ago',
            'experience' => 'Mid-Level',

        ],
        [
            'id' => 5,
                        'title' => 'HR Specialist',
                'company' => 'Talent Hub',
                'location' => 'Cairo, Egypt',
                'job_type' => 'Full-time',
                'work_type' => 'On-site',
                'category' => 'Human Resources',
                'company_logo' => 'Hr.png',
            'posted_at' => '5 days ago',
            'experience' => 'Mid-Level',
        ],
        [
            'id' => 6,
            'title' => 'Marketing Specialist',
            'company' => 'Creative Minds Agency',
            'location' => 'Cairo, Egypt',
            'job_type' => 'Full-time',
            'work_type' => 'Hybrid',
            'category' => 'Marketing',
            'company_logo' => 'mark.png',
            'posted_at' => '5 days ago',
            'experience' => '3+ years',
        ],  [
            'id' => 7,
            'title' => 'Data Scientist',
            'company' => 'banan',
            'location' => 'cairo, Egypt',
            'job_type' => 'Internship',
            'work_type' => 'On-site',
            'category' => 'Data Analysis',
            'company_logo' => 'datasc.png',
            'posted_at' => '5 days ago',
            'experience' => '1 year',

        ],  [
            'id' => 8,
            'title' => 'Data Scientist',
            'company' => 'Data collector',
            'location' => 'Alexandria, Egypt',
            'job_type' => 'Internship',
            'work_type' => 'Hybrid',
            'category' => 'Data Analysis',
            'company_logo' => 'Data Analysis.png',
            'posted_at' => '5 days ago',
            'experience' => '1-2 years',

        ],
    ];

    return view('jobs.index', compact('jobs'));
});

//  Details Page (Shows Full Job Info)
Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
            'id' => 1,
            'title' => 'Software Engineer',
            'company' => 'ABC Tech',
            'location' => 'Cairo, Egypt',
            'job_type' => 'Full-time',
            'work_type' => 'On-site',
            'category' => 'Programming',
            'company_logo' => 'abc_tech_logo.png',
            'description' => 'Develop and maintain web applications using Laravel and Vue.js.',
            'responsibilities' => 'Write clean, scalable code and collaborate with the team.',
            'skills' => 'PHP, Laravel, JavaScript, Vue.js, MySQL',
            'technologies' => 'Laravel, Vue.js, Tailwind CSS',
            'salary' => '5000 - 7000 EGP',
            'benefits' => 'Health insurance, Flexible hours, Remote work option',
            'experience' => 'Mid-Level',
            'deadline' => '2024-04-15',
            'posted_at' => '2024-03-01',
        ],
        [
            'id' => 2,
            'title' => 'Project Manager',
            'company' => 'XYZ Solutions',
            'location' => 'Remote',
            'job_type' => 'Part-time',
            'work_type' => 'Remote',
            'category' => 'Management',
            'company_logo' => 'xyz_solutions_logo.png',
            'description' => 'Manage projects and coordinate between teams.',
            'responsibilities' => 'Ensure project deadlines are met and manage resources.',
            'skills' => 'Agile, Scrum, Leadership, Communication',
            'technologies' => 'Jira, Trello, Slack',
            'salary' => '8000 - 10000 EGP',
            'benefits' => 'Bonuses, Remote work',
            'experience' => 'Senior',
            'deadline' => '2024-04-20',
            'posted_at' => '2024-03-02',
        ],
        [
            'id' => 3,
            'title' => 'Data Analyst',
            'company' => 'Data Corp',
            'location' => 'Alexandria, Egypt',
            'job_type' => 'Internship',
            'work_type' => 'Hybrid',
            'category' => 'Data Analysis',
            'company_logo' => 'data_corp_logo.png',
            'description' => 'Analyze company data and create reports.',
            'responsibilities' => 'Use SQL and Python for data processing.',
            'skills' => 'SQL, Python, Excel, Data Visualization',
            'technologies' => 'Power BI, Tableau, Pandas',
            'salary' => '2000 - 3000 EGP',
            'benefits' => 'Training, Career growth opportunities',
            'experience' => 'Entry-Level',
            'deadline' => '2024-04-30',
            'posted_at' => '2024-03-05',
        ],
        [
            'id' => 4,
            'title' => 'Wordpress developer',
            'company' => 'Ak Tech',
            'location' => 'Cairo, Egypt',
            'job_type' => 'Full-time',
            'work_type' => 'On-site',
            'category' => 'Programming',
            'company_logo' => 'wp.png',
            'description' => 'Develop and maintain web applications using Laravel and Vue.js.',
            'responsibilities' => 'Write clean, scalable code and collaborate with the team.',
            'skills' => 'PHP, Laravel, JavaScript, Vue.js, MySQL',
            'technologies' => 'Laravel, Vue.js, CSS',
            'salary' => '5000 - 7000 EGP',
            'benefits' => 'Health insurance, Flexible hours, Remote work option',
            'experience' => 'Mid-Level',
            'deadline' => '2024-04-15',
            'posted_at' => '2024-03-01',
        ],
        [
            'id' => 5,
            'title' => 'HR Specialist',
            'company' => 'Talent Hub',
            'location' => 'Cairo, Egypt',
            'job_type' => 'Full-time',
            'work_type' => 'On-site',
            'category' => 'Human Resources',
            'company_logo' => 'Hr.png',
            'description' => 'Manage recruitment, employee relations, and HR policies.',
            'responsibilities' => 'Handle recruitment processes, conduct interviews, and onboard new employees.',
            'skills' => 'Recruitment, Employee Relations, HR Policies, Communication',
            'technologies' => 'HRMS Software, Microsoft Office, LinkedIn Recruiter',
            'salary' => '6000 - 9000 EGP',
            'benefits' => 'Health insurance, Performance bonuses, Professional development',
            'experience' => 'Mid-Level',
            'deadline' => '2024-05-15',
            'posted_at' => '2024-03-10',
        ],
        [
            'id' => 6,
            'title' => 'Marketing Specialist',
            'company' => 'Creative Minds Agency',
            'location' => 'Cairo, Egypt',
            'job_type' => 'Full-time',
            'work_type' => 'Hybrid',
            'category' => 'Marketing',
            'company_logo' => 'mark.png',
            'description' => 'Develop and execute marketing strategies to drive brand awareness and customer engagement.',
            'responsibilities' => 'Plan and manage digital marketing campaigns, analyze market trends, and collaborate with the creative team.',
            'skills' => 'Digital Marketing, Social Media Management, SEO, Content Creation',
            'technologies' => 'Google Analytics, Hootsuite, Canva, Adobe Creative Suite',
            'salary' => '7000 - 10000 EGP',
            'benefits' => 'Flexible working hours, Performance bonuses, Professional development',
            'experience' => 'Mid-Level',
            'deadline' => '2024-05-20',
            'posted_at' => '2024-03-12',
        ],
        [
            'id' => 7,
            'title' => 'Data Scientist',
            'company' => 'banan',
            'location' => 'cairo, Egypt',
            'job_type' => 'Internship',
            'work_type' => 'On-site',
            'category' => 'Data Analysis',
            'company_logo' => 'datasc.png',
            'description' => 'Analyze company data and create reports.',
            'responsibilities' => 'Use SQL and Python for data processing.',
            'skills' => 'SQL, Python, Excel, Data Visualization',
            'technologies' => 'Power BI, Tableau, Pandas',
            'salary' => '2000 - 3000 EGP',
            'benefits' => 'Training, Career growth opportunities',
            'experience' => 'Entry-Level',
            'deadline' => '2024-04-30',
            'posted_at' => '2024-03-05',
        ],  [
            'id' => 8,
            'title' => 'Data Scientist',
            'company' => 'Data collector',
            'location' => 'Alexandria, Egypt',
            'job_type' => 'Internship',
            'work_type' => 'Hybrid',
            'category' => 'Data Analysis',
            'company_logo' => 'Data Analysis.png',
            'description' => 'Analyze company data and create reports.',
            'responsibilities' => 'Use SQL and Python for data processing.',
            'skills' => 'SQL, Python, Excel, Data Visualization',
            'technologies' => 'Power BI, Tableau, Pandas',
            'salary' => '2000 - 3000 EGP',
            'benefits' => 'Training, Career growth opportunities',
            'experience' => 'Entry-Level',
            'deadline' => '2024-04-30',
            'posted_at' => '2024-03-05',
        ],
    ];

    $job = collect($jobs)->firstWhere('id', $id);

    //  if job is not found
    if (!$job) {
        abort(404);
    }

    //  similar jobs based on category
    $similar_jobs = collect($jobs)
        ->where('category', $job['category'])
        ->where('id', '!=', $id)
        ->take(3);

    return view('jobs.show', compact('job', 'similar_jobs'));
});

