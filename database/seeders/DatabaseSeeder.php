<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            PmpBasicSeeder::class,
            UserSeeder::class,
            PmpUserSeeder::class,
//            PmpInternshipSeeder::class,
            PmpThesisSeeder::class,
            //            BuildingSeeder::class,
            //            RoomSeeder::class,
            //            FacultySeeder::class,
            //            DepartmentSeeder::class,
            //            UserSeeder::class,
            //            StudentSeeder::class,
            //            LecturerSeeder::class,
            //            StaffSeeder::class,
            /**
             * Seeder Manajemen Curriculum
             */
            //            CurriculumSeeder::class,
            //            CurriculumPeoSeeder::class,
            //            CurriculumPloSeeder::class,
            //            CurriculumPeoPloSeeder::class,
            //            CurriculumIndicatorSeeder::class,
            //            CurriculumBokSeeder::class,
            //            CurriculumBokDetailSeeder::class,
            //            CourseSeeder::class,
            //            CoursePlanSeeder::class,
            //            CoursePlanRequirementSeeder::class,
            //            CoursePlanLoSeeder::class,
            //            CoursePlanReferenceSeeder::class,
            //            CoursePlanMaterialSeeder::class,
            //            CoursePlanMediaSeeder::class,
            //            CoursePlanLecturerSeeder::class,
            //            CoursePlanDetailSeeder::class,
            //            CoursePlanDetailActivitySeeder::class,
            //            CoursePlanAssessmentSeeder::class,
            //            CourseCurriculumIndicatorSeeder::class,
            /**
             * Seeder Assessment
             */
            //            AssessmentDetailSeeder::class,
            //            AssessmentCriteriaSeeder::class,
            //            AssessmentRubricSeeder::class,
            //            AssessmentSeeder::class,
            /**
             * Seeder Manajemen Kelas
             */
            //            PeriodSeeder::class,
            //            ClassCourseSeeder::class,
            //            ClassScheduleSeeder::class,
            //            ClassLecturerSeeder::class,
            //            StudyPlanSeeder::class,
            //            StudyPlanDetailSeeder::class,
            /**
             * Seeder Manajemen Jadwal
             */
            //            ClassMeetingSeeder::class,
            //            ClassAttendanceSeeder::class,
            /**
             * Seeder Manajemen Penelitian dan Pengabdian
             */
            //            ResearchSchemaSeeder::class,
            //            ResearchSeeder::class,
            //            ResearchMemberSeeder::class,
            //            CommunityServiceSchemaSeeder::class,
            //            CommunityServiceSeeder::class,
            //            CommunityServiceMemberSeeder::class,
            /**
             * Seeder Manajemen Data Publikasi
             */
            //            PublisherSeeder::class,
            //            PublicationTypeSeeder::class,
            //            PublicationSeeder::class,
            //            PublicationAuthorSeeder::class,
            /**
             * Seeder Manajemen Kerja Praktek
             */
            //            InternshipCompanySeeder::class,
            //            InternshipProposalSeeder::class,
            //            InternshipSeeder::class,
            //            InternshipLogbookSeeder::class,
            //            InternshipSeminarAudienceSeeder::class,
            /**
             * Seeder Manajemen Tugas Akhir
             */
            //            ThesisRubricSeeder::class,
            //            ThesisRubricDetailSeeder::class,
            //            ThesisTopicSeeder::class,
            //            ThesisSupervisorSeeder::class,
            //            ThesisSupervisorSeeder::class,
            //            ThesisProposalSeeder::class,
            //            ThesisProposalAudienceSeeder::class,
            //            ThesisLogbookSeeder::class,
            //            ThesisSeminarSeeder::class,
            //            ThesisSeminarAudienceSeeder::class,
            //            ThesisSeminarReviewerSeeder::class,
            //            ThesisDefenseSeeder::class,
            //            ThesisDefenseExaminerSeeder::class,
            //            ThesisDefenseScoreSeeder::class

            /**
             * Seeder khusus untuk PmP
             */
            PmpInternshipSeeder::class,
        ]);
    }
}
