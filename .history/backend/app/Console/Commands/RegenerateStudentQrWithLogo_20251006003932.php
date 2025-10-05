<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;

class RegenerateStudentQrWithLogo extends Command
{
    protected $signature = 'qr:regenerate-logo';
    protected $description = '🧼 Delete old QR codes and regenerate all with logo';

    public function handle()
    {
        $students = Student::whereNotNull('qr_token')->get();

        if ($students->isEmpty()) {
            $this->warn('⚠️ No students found with existing QR codes.');
            return;
        }

        // 🧨 STEP 0: Delete the entire qr_code folder first (hard reset)
        if (Storage::disk('public')->exists('qr_code')) {
            Storage::disk('public')->deleteDirectory('qr_code');
            $this->warn('🧼 Cleared old QR code files.');
        }
        Storage::disk('public')->makeDirectory('qr_code');

        // ✅ STEP 1: Regenerate each student's QR with logo
        foreach ($students as $student) {
            $qrcode = QrCode::create($student->qr_code)
                ->setSize(300)
                ->setMargin(10);

            $logoPath = asset('storage/gallery/hnvslogoqr.png');
            if (!file_exists($logoPath)) {
                $this->error("🚫 Logo file not found at: {$logoPath}");
                return;
            }

            $logo = Logo::create($logoPath)
                ->setResizeToWidth(60)
                ->setPunchoutBackground(true);

            $writer = new PngWriter();
            $result = $writer->write($qrcode, $logo);

            $fileName = 'qr_code/' . $student->qr_token . '.png';
            Storage::disk('public')->put($fileName, $result->getString());

            // 🔁 Update the student record with the new path
            $student->update([
                'qr_path' => env('APP_URL') . 'storage/' . $fileName
            ]);

            $this->info("✅ Regenerated QR for: {$student->firstname} {$student->lastname}");
        }

        $this->info('🎉 All QR codes regenerated successfully with logo!');
    }
}
