<?php

namespace Database\Factories;

use App\Models\ClassAttendance;
use App\Models\ClassMeeting;
use App\Models\CourseEnrollmentDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassAttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassAttendance::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_enrollment_detail_id' => CourseEnrollmentDetail::factory(),
            'class_meeting_id' => ClassMeeting::factory(),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'meet_no' => $this->faker->numberBetween(-10000, 10000),
            'device_id' => $this->faker->word(),
            'device_name' => $this->faker->word(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'attendance_status' => $this->faker->numberBetween(-10000, 10000),
            'need_attention' => $this->faker->numberBetween(-10000, 10000),
            'information' => $this->faker->text(),
            'permit_reason' => $this->faker->text(),
            'permit_file' => $this->faker->word(),
            'rating' => $this->faker->randomFloat(0, 0, 9999999999.),
            'feedback' => $this->faker->text(),
        ];
    }
}
