<?php

namespace App\Controller;

use App\Entity\DataSet;
use App\Entity\RequestData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnalyzesController extends AbstractController
{
    /**
     * @Route("/analyzes", name="analyzes")
     */
    public function index()
    {
        return $this->render('analyzes/epa.html.twig', [
            'methods' => '',
            'lines' => '',
            'code200' => null,
            'code404' => null,
            'code302' => null
        ]);

    }

    /**
     * @Route("/upload", name="upluad")
     */
    public function uploadControllr(Request $request)
    {
        ini_set('memory_limit', '1024M');
        $file = $request->files->get('myfile');
        $fileName = $file->getClientOriginalName();

        $file->move('uploads/', $fileName);

        $handle = fopen("uploads/".$fileName, "r");
        $lines = [];

        if ($handle) {
            $invalidRequest = 0;
            $dataSet = new DataSet();

            while (($line = fgets($handle)) !== false) {
                $line = preg_replace("/\"/", "", $line);
                $lineData = explode(' ',$line);

                try {
                    $dataSet->readMethod($lineData[2]);
                    $lines [] = (new RequestData())
                        ->setHost($lineData[0])
                        ->setDatetime($lineData[1])
                        ->setRequest(['method' => $lineData[2],'url' => $lineData[3], 'protocol' => $lineData[4], 'protocol_version' => $lineData[4]])

                        ->setResponseCode($lineData[5])
                        ->setDocumntSize($lineData[6])
                    ;
                } catch (\Exception $exception) {
                    $invalidRequest ++;
                }

            };
            fclose($handle);
            $jsonfile = fopen("uploads/".'t1.json', "w");
            fwrite($jsonfile,json_encode($lines));
            fclose($jsonfile);

        } else {
            // error opening the file.
        }
        $json = json_encode( $dataSet, JSON_UNESCAPED_UNICODE );
        $methods = file_get_contents('uploads/t1.json');

        $arr1 = json_decode($methods);
        $code200 = 200;
        $code404 = 404;
        $code302 = 302;

        return $this->render('analyzes/epa.html.twig', [
            'methods' => $json,
            'lines' =>$methods,
            'code200'=> array_count_values(array_column($arr1, 'response_code'))[$code200],
            'code404'=> array_count_values(array_column($arr1, 'response_code'))[$code404],
            'code302'=> array_count_values(array_column($arr1, 'response_code'))[$code302],
        ]);

    }

    /**
     * @Route("/charts", name="charts")
     */
    public function chartsAction()
    {
        $content = file_get_contents('uploads/t1.json');
        return new JsonResponse(json_decode($content));



    }
}

