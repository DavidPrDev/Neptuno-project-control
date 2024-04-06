<?php

class SEO
{
    public static function getSeo(string $cadena) : string
    {
        $stopWords = array("un", "una", "unos", "unas", "el", "la", "los", "las", "de", "en", "y", "por"); // Definir tus stopwords aquí

        //Convertir la cadena a minúsculas y quitar acentos y caracteres especiales
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', strtolower($cadena));

        // Reemplazar espacios y stopwords
        $slug = str_replace("'","",$slug);

        // Reemplazar espacios y stopwords
        $slug = preg_replace('/\b('.implode('|',$stopWords).')\b/', '', $slug); // quitar stopwords

        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug); //reemplazar caracteres no alfanuméricos por guión
        
        // Eliminar guiones múltiples y recortar guiones en los extremos
        $slug = preg_replace('/-+/', '-', $slug); // reemplazar guiones múltiples por un solo guión
        $slug = trim($slug, '-'); // recortar guiones en los extremos
    
        return $slug;

    }
}


?>