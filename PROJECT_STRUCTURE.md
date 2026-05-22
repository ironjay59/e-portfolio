# SOEPAS Folder Structure

```
soepas/
├── app/
│   ├── Console/
│   │   ├── Commands/
│   │   └── Kernel.php
│   ├── Events/
│   │   ├── ArtifactUploaded.php
│   │   ├── AssessmentCompleted.php
│   │   └── CQIActionCreated.php
│   ├── Exceptions/
│   │   └── Handler.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── PasswordResetController.php
│   │   │   ├── Api/
│   │   │   │   ├── StudentOutcomeController.php
│   │   │   │   ├── PerformanceIndicatorController.php
│   │   │   │   ├── ArtifactController.php
│   │   │   │   ├── RubricController.php
│   │   │   │   ├── AssessmentController.php
│   │   │   │   ├── AttainmentController.php
│   │   │   │   ├── CQIController.php
│   │   │   │   ├── ReportController.php
│   │   │   │   └── DashboardController.php
│   │   │   ├── Admin/
│   │   │   │   ├── UserController.php
│   │   │   │   ├── ProgramController.php
│   │   │   │   ├── CurriculumController.php
│   │   │   │   └── CourseController.php
│   │   │   ├── Student/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProfileController.php
│   │   │   │   └── PortfolioController.php
│   │   │   ├── Faculty/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── AssessmentController.php
│   │   │   │   └── RubricController.php
│   │   │   └── ProgramChair/
│   │   │       ├── DashboardController.php
│   │   │       ├── ReportController.php
│   │   │       └── CQIController.php
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── CheckRole.php
│   │   │   └── AuditLog.php
│   │   ├── Requests/
│   │   │   ├── StoreStudentOutcomeRequest.php
│   │   │   ├── StoreArtifactRequest.php
│   │   │   ├── StoreRubricRequest.php
│   │   │   ├── StoreAssessmentRequest.php
│   │   │   └── StoreCQIActionRequest.php
│   │   └── Resources/
│   │       ├── StudentOutcomeResource.php
│   │       ├── ArtifactResource.php
│   │       └── AttainmentResource.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Role.php
│   │   ├── Permission.php
│   │   ├── Student.php
│   │   ├── Faculty.php
│   │   ├── Program.php
│   │   ├── Curriculum.php
│   │   ├── Course.php
│   │   ├── StudentOutcome.php
│   │   ├── PerformanceIndicator.php
│   │   ├── Assessment.php
│   │   ├── Rubric.php
│   │   ├── RubricCriteria.php
│   │   ├── StudentArtifact.php
│   │   ├── ArtifactMapping.php
│   │   ├── Score.php
│   │   ├── AttainmentResult.php
│   │   ├── CQIAction.php
│   │   ├── Notification.php
│   │   └── AuditLog.php
│   ├── Policies/
│   │   ├── StudentPolicy.php
│   │   ├── ArtifactPolicy.php
│   │   ├── RubricPolicy.php
│   │   ├── AssessmentPolicy.php
│   │   └── CQIActionPolicy.php
│   ├── Services/
│   │   ├── StudentOutcomeService.php
│   │   ├── AttainmentCalculationService.php
│   │   ├── ArtifactValidationService.php
│   │   ├── RubricScoringService.php
│   │   ├── ReportGenerationService.php
│   │   ├── CQIAnalysisService.php
│   │   └── NotificationService.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       └── RouteServiceProvider.php
├── bootstrap/
│   └── app.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   ├── filesystems.php
│   ├── permission.php
│   └── soepas.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_02_000002_create_roles_permissions_tables.php
│   │   ├── 2024_01_03_000003_create_students_table.php
│   │   ├── 2024_01_04_000004_create_faculty_table.php
│   │   ├── 2024_01_05_000005_create_programs_table.php
│   │   ├── 2024_01_06_000006_create_curricula_table.php
│   │   ├── 2024_01_07_000007_create_courses_table.php
│   │   ├── 2024_01_08_000008_create_student_outcomes_table.php
│   │   ├── 2024_01_09_000009_create_performance_indicators_table.php
│   │   ├── 2024_01_10_000010_create_assessments_table.php
│   │   ├── 2024_01_11_000011_create_rubrics_table.php
│   │   ├── 2024_01_12_000012_create_rubric_criteria_table.php
│   │   ├── 2024_01_13_000013_create_student_artifacts_table.php
│   │   ├── 2024_01_14_000014_create_artifact_mappings_table.php
│   │   ├── 2024_01_15_000015_create_scores_table.php
│   │   ├── 2024_01_16_000016_create_attainment_results_table.php
│   │   ├── 2024_01_17_000017_create_cqi_actions_table.php
│   │   ├── 2024_01_18_000018_create_notifications_table.php
│   │   └── 2024_01_19_000019_create_audit_logs_table.php
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── RolePermissionSeeder.php
│   │   ├── ProgramSeeder.php
│   │   ├── StudentOutcomeSeeder.php
│   │   ├── PerformanceIndicatorSeeder.php
│   │   ├── UserSeeder.php
│   │   └── CourseSeeder.php
│   └── factories/
│       ├── UserFactory.php
│       ├── StudentFactory.php
│       ├── CourseFactory.php
│       ├── StudentArtifactFactory.php
│       └── AssessmentFactory.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── auth.blade.php
│   │   │   └── navigation.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   ├── register.blade.php
│   │   │   └── forgot-password.blade.php
│   │   ├── dashboard/
│   │   │   ├── index.blade.php
│   │   │   ├── student.blade.php
│   │   │   ├── faculty.blade.php
│   │   │   ├── program-chair.blade.php
│   │   │   └── accreditor.blade.php
│   │   ├── admin/
│   │   ├── student/
│   │   ├── faculty/
│   │   ├── program-chair/
│   │   └── accreditor/
│   └── css/
│       └── app.css
├── routes/
│   ├── web.php
│   ├── api.php
│   └── channels.php
├── storage/
│   ├── app/
│   │   ├── artifacts/
│   │   ├── reports/
│   │   └── exports/
│   └── logs/
├── tests/
│   ├── Feature/
│   ├── Unit/
│   └── TestCase.php
├── .env.example
├── .dockerignore
├── Dockerfile
├── docker-compose.yml
├── artisan
├── composer.json
├── phpunit.xml
├── README.md
└── PROJECT_STRUCTURE.md
```

## Directory Purposes

- **app/**: Core application code
- **bootstrap/**: Framework bootstrapping
- **config/**: Configuration files
- **database/**: Migrations, seeders, factories
- **resources/**: Views, CSS, JavaScript
- **routes/**: Route definitions
- **storage/**: File storage
- **tests/**: Automated tests
