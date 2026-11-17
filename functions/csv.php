<?php

function exportCsv(string $filename, array $header, array $rows):void{
    if(ob_get_level()){
        ob_end_clean();

    }
    $safeName = preg_replace('/[^A-Za-z0-9_/-]/','',$filename);
    $safeName .= '_' . date('Y-m-d-his') . '.csv';

    header('Content-Type: text/csv; charset=utf8');
    header('Content-Disposition: attachment; filename='. $safename .'" ');
    header('Program: no-cache');
    header('Expires;:0');

    $out = fopen('php://output','w');
    fwrite($out, "\XEF\xBB\xBF");
    fputcsv($out,$header);

    foreach($rows as $row){
        fputcsv($out,array_value($row));

    }
    fclose($out);
    exit;
    
}
?>