<?php
/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 10/08/2018
 * Time: 16:27
 */



namespace App\Controller\Phones;

use Cake\Filesystem\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

trait AdditionalOptionsTrait
{
    /**
     * It changes the config file to store the current logged in user credentials.
     *
     * @return zip file containing the diagnosis programme
     */
    public function download() {

        $this->autoRender= false;
        //  Write the config ini file
        $file = new File( WWW_ROOT.DS.'files'.DS.'IPhoneDiagnostics'.DS.'config.ini');

        $user = $this->Auth->user();



        $file->write(
            "[DEFAULT] \n"
            . 'email = ' . $user["email"] . "\n"
            . 'api_key = ' . $user["api_key_plain"] . "\n"
            . 'server_address = ' . 'http://' .$this->request->host() . "\n"
        );

        $file->close(); // Be sure to close the file when you're done

        $this->compressFolder();

        $file_path = WWW_ROOT.DS.'files'.DS.'iPhoneDiagnostics.zip';

        return $this->response->withFile($file_path, [
            'download' => true,
            'name' => 'iPhoneDiagnosis.zip',
        ]);
    }

    /**
     * Compress the diagnosis folder recursively by maintaining the files' permissions
     */
    protected function compressFolder() {
        // Get real path for our folder
        // The folder must not be a symbolic link
        $rootPath =  realpath(WWW_ROOT.DS.'files'.DS.'IPhoneDiagnostics');

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open('files/iPhoneDiagnostics.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $stat = stat($filePath);
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
                $zip->setExternalAttributesName($relativePath, ZipArchive::OPSYS_UNIX, $stat["mode"]);
            }
        }
        // Zip archive will be created only after closing object
        $zip->close();
    }

    /**
     * Used to generate a CSV file of the current table
     */
    public function export()
    {
        $query = $this->Phones
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', ['search' => $this->request->getQueryParams()])
            ->contain(['Repairs', 'ItemReturns', 'SupplierOrders.Suppliers'])
            ->distinct()->all();

        $_serialize = 'query';
        $_header = ['Internal ID', 'IMIEI', 'Serial N', 'Status', 'Description', 'Comments',
            'Battery Cycles', 'Created', 'Supplier Name', 'Repair description'];
        $_extract = [
            'id',
            'imiei',
            'serial_number',
            'status',
            'label',
            'comments',
            'battery_cycles',
            'created',
            'supplier_order.supplier.name',
            function ($row) {
                $labelsList = '';
                foreach($row['repairs'] as $repair) {
                    $labelsList .= $repair['id']. ': Reason (' . $repair['reason']. ') '
                        . ' Comments: ' . $repair['comments'];
                }
                return $labelsList;
            }
        ];

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('query', '_serialize', '_header', '_extract'));
    }

    public function pdfLabel($id = null) {
        $phone = $this->Phones->get($id, [
            'contain' => ['Models.Manufacturers']
        ]);

        $this->viewBuilder()->options([
            'pdfConfig' => [
                'margin' => [
                    'bottom' => 1,
                    'left' => 1,
                    'right' => 1,
                    'top' => 1
                ],
                'orientation' => 'portrait',
                'pageSize' => [89, 35],
                'title' => 'Name'
            ]
        ]);
        $this->set(compact('phone'));
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
    }
}