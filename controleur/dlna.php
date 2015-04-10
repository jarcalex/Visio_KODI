<?php
    if (isset($_POST['rescan'])) {
        $detail = array();
        exec("sudo /etc/init.d/minidlna force-reload", $detail, $return_var);
        echo "Retour: ".$return_var."  Output: ";
        var_dump($detail);
        echo "<br />";
    }
    
     $db_dlna = new SQLite3('/var/lib/minidlna/files.db');
    // gestion des erreurs
    if (empty($db_dlna)) {
        $LstFile = "<div class='alert alert-error'>BDD non disponible!</div>";
    } else {
        $res = $db_dlna->query("select Distinct(NAME) AS filename from OBJECTS where CLASS = \"item.videoItem\"");
        $LstFile = "<h3 style='color:#1c7792;text-decoration:underline;margin-top: 0;'>Liste des fichiers publiés</h3><lu>";
        $nb_file=0;
        while($tt = $res->fetchArray(SQLITE3_ASSOC)) {
            $LstFile .= "<li style='margin-left: 10px;'>".$tt['filename']."</li>";
            $nb_file++;
        }
        if ($nb_file == 0) {
            $LstFile .= "<li style='margin-left: 10px;'>N/A</li>";
        }
        $LstFile .= "</lu>";
    }