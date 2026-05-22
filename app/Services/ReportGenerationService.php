<?php

namespace App\Services;

use App\Models\AttainmentResult;
use App\Models\StudentOutcome;
use App\Models\Score;
use App\Models\StudentArtifact;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportGenerationService
{
    /**
     * Generate individual student portfolio PDF
     */
    public function generateStudentPortfolioPDF($student)
    {
        $artifacts = $student->artifacts()
            ->where('validation_status', 'validated')
            ->with('mappings.studentOutcome')
            ->get();

        $attainments = AttainmentResult::where('student_id', $student->id)
            ->with('studentOutcome')
            ->get();

        $pdf = Pdf::loadView('reports.student-portfolio', [
            'student' => $student,
            'artifacts' => $artifacts,
            'attainments' => $attainments,
        ]);

        return $pdf->download("portfolio_{$student->student_id}.pdf");
    }

    /**
     * Generate SO attainment report
     */
    public function generateSOAttainmentReport($program, $academicYear)
    {
        $outcomes = $program->studentOutcomes()
            ->with(['attainmentResults' => function ($q) use ($academicYear) {
                $q->where('academic_year', $academicYear);
            }])
            ->get();

        $pdf = Pdf::loadView('reports.so-attainment', [
            'program' => $program,
            'outcomes' => $outcomes,
            'academicYear' => $academicYear,
        ]);

        return $pdf->download("so_attainment_{$program->code}_{$academicYear}.pdf");
    }

    /**
     * Generate cohort attainment report
     */
    public function generateCohortAttainmentReport($program, $cohort, $academicYear)
    {
        $outcomes = $program->studentOutcomes()
            ->with(['attainmentResults' => function ($q) use ($cohort, $academicYear) {
                $q->where('cohort', $cohort)
                  ->where('academic_year', $academicYear);
            }])
            ->get();

        $pdf = Pdf::loadView('reports.cohort-attainment', [
            'program' => $program,
            'cohort' => $cohort,
            'outcomes' => $outcomes,
            'academicYear' => $academicYear,
        ]);

        return $pdf->download("cohort_attainment_{$cohort}_{$academicYear}.pdf");
    }

    /**
     * Generate performance indicator report
     */
    public function generatePerformanceIndicatorReport($program, $academicYear)
    {
        $indicators = $program->studentOutcomes()
            ->with('performanceIndicators')
            ->get()
            ->flatMap->performanceIndicators;

        $pdf = Pdf::loadView('reports.performance-indicators', [
            'program' => $program,
            'indicators' => $indicators,
            'academicYear' => $academicYear,
        ]);

        return $pdf->download("performance_indicators_{$program->code}_{$academicYear}.pdf");
    }

    /**
     * Generate CQI report
     */
    public function generateCQIReport($program, $academicYear)
    {
        $actions = $program->studentOutcomes()
            ->with('cqiActions')
            ->get()
            ->flatMap->cqiActions;

        $pdf = Pdf::loadView('reports.cqi', [
            'program' => $program,
            'actions' => $actions,
            'academicYear' => $academicYear,
        ]);

        return $pdf->download("cqi_report_{$program->code}_{$academicYear}.pdf");
    }

    /**
     * Generate accreditation evidence package
     */
    public function generateAccreditationPackage($program, $academicYear)
    {
        $data = [
            'program' => $program,
            'outcomes' => $program->studentOutcomes()->get(),
            'attainments' => AttainmentResult::whereHas('studentOutcome', 
                function ($q) use ($program) {
                    $q->where('program_id', $program->id);
                })
                ->where('academic_year', $academicYear)
                ->get(),
            'cqiActions' => $program->studentOutcomes()
                ->with('cqiActions')
                ->get()
                ->flatMap->cqiActions,
        ];

        $pdf = Pdf::loadView('reports.accreditation-package', $data);

        return $pdf->download("accreditation_package_{$program->code}_{$academicYear}.pdf");
    }

    /**
     * Export attainment data to Excel
     */
    public function exportAttainmentToExcel($program, $academicYear)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Student Outcome Attainment Report');
        $sheet->setCellValue('A2', "Program: {$program->name}");
        $sheet->setCellValue('A3', "Academic Year: {$academicYear}");

        $row = 5;
        $sheet->setCellValue("A{$row}", 'SO Code');
        $sheet->setCellValue("B{$row}", 'SO Title');
        $sheet->setCellValue("C{$row}", 'Target %');
        $sheet->setCellValue("D{$row}", 'Achieved %');
        $sheet->setCellValue("E{$row}", 'Status');

        $row++;

        foreach ($program->studentOutcomes as $outcome) {
            $attainment = AttainmentResult::where('student_outcome_id', $outcome->id)
                ->where('academic_year', $academicYear)
                ->first();

            $sheet->setCellValue("A{$row}", $outcome->code);
            $sheet->setCellValue("B{$row}", $outcome->title);
            $sheet->setCellValue("C{$row}", $outcome->target_attainment);
            $sheet->setCellValue("D{$row}", $attainment?->attainment_percentage ?? 'N/A');
            $sheet->setCellValue("E{$row}", $attainment?->attainment_level ?? 'Not Assessed');

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = "attainment_{$program->code}_{$academicYear}.xlsx";

        $writer->save($filename);
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
