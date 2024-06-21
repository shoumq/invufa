<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordController extends Controller
{
    public function GenerateWord(Request $request) {
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="document.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        
        $section->addText("Название документа: " . $request->input('title'), ['bold' => true]);
        $section->addText("Дата создания: " . date("H:i, d.m.Y"));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("php://output");
    }
}
