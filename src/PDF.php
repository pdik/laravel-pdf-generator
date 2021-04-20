<?php
namespace Pdik\laravelPdfGenerator;
use Illuminate\Support\Facades\Storage;
use QCod\AppSettings;
class PDF
{
    public $date;
    public $file;
    public $model;
    public function __construct($model)
    {
        $this->model = $model;
    }
    public function generate($name, array $pages, $view, $coversheet = false){
        $this->file = new tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->file->SetCreator(PDF_CREATOR);
        $this->file->SetAuthor('Pdik systems');
        $this->file->SetTitle($name);
        $this->file->SetSubject($name);
        $this->file->SetKeywords('PDF,'.$name.'');
        $this->file->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->file->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->file->SetFooterMargin(PDF_MARGIN_FOOTER);
        $this->file->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->file->SetPrintHeader(false);
        $this->file->setPrintFooter(false);
        // set image scale factor
        $this->file->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $this->file->Output(storage_path('/app/files/'.config('Generatepdf.path', 'pdf').''));
        /**
         * coversheet
         */
        if($coversheet){

            $this->file->AddPage();
            // get the current page break margin
            $bMargin = $this->file->getBreakMargin();
            // get current auto-page-break mode
            $auto_page_break = $this->file->getAutoPageBreak();
            // disable auto-page-break
            $this->file->SetAutoPageBreak(false, 0);
            // set bacground image
            $img_file = AppSettings::get('report_coversheet');
            $this->file->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
            // restore auto-page-break status
            $this->file->SetAutoPageBreak($auto_page_break, $bMargin);
            // // set the starting point for the page content
            $this->file->setPageMark();
            $this->file->endPage();
            // reset pointer to the last page
            $this->file->lastPage();
        }
        /**
         * End coversheet
         */
        foreach ($pages as $page ){
            /**
             * Load data
             */
        }

    }
}