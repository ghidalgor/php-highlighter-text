<?php

function text_highlighter($originText, $keymatch){
#Variables
//$keywordCont = 0;
$keywordSize = 0;
//$keywordAux = null;
$keywordPos = 0;
$keyTemp = "";
$allText = array();
$keyword = array();
$finalText  = "";

if($originText!="" && $keymatch!="")
{

#Capch characters and put it inside array()
$allText = captureCharacter($originText);
$keyword = captureCharacter($keymatch);

$keywordSize = count($keyword);

	for($pos=0; $pos<count($allText); $pos++)
	{

		if((strtolower($allText[$pos]) == strtolower($keyword[$keywordPos])) || (extraCharacters($allText[$pos]) == $keyword[$keywordPos])) {

			$keyTemp = $keyTemp.$allText[$pos];
			if(($keywordSize-1) == $keywordPos){
				$keywordPos = 0;
				
				$finalText = $finalText."<span class=\"text_highlighter\">".$keyTemp."</span>";
				$keyTemp = "";
			}

			$keywordPos++;

		}else{

			if($keywordPos>0){
				$finalText = $finalText.$keyTemp;
				$keyTemp = null;
			}

			$keywordPos = 0;
			$finalText = $finalText.$allText[$pos];
		}

	}

	echo $finalText;
}


}

function extraCharacters($character){
	$found = null;

	#CONST
    $tildes   = array('Á','É','Í','Ó','Ú','Ñ','á','é','í','ó','ú','ñ','a','e','i','o','u');
    $noTildes = array('A','E','I','O','U','N','a','e','i','o','u','n','á','é','í','ó','ú');

    for($pos=0; $pos<count($tildes); $pos++)
    {
 		if (strcmp(mb_substr($character,0,1,'UTF-8'), mb_substr($tildes[$pos],0,1,'UTF-8')) == 0)	{
    		$found = $noTildes[$pos];
		}

    }#For

	return $found;
}

function captureCharacter($textChain){
$arrData = array();

	for ($position = 0, $textLen = mb_strlen($textChain,'UTF-8'); $position < $textLen; $position++)
	{
        $arrData[] = mb_substr($textChain,$position,1,'UTF-8');
	}

	//http://blog.openalfa.com/como-trabajar-con-cadenas-de-texto-en-php
	return $arrData;
}

function text_highlighter2($fulltext, $keyword)
{
	#Var
	$arrayRet = array(); # This array store the results.
	$search = "";
	$highlightersCount = 0;
	$wordLenght = 0; # Lenght of Keyword
	$replaced_string = "";
	$replaceWord = "";


	#$fulltext = strtolower($fulltext); // lower case
	#$keyword = strtolower($keyword);// lower case
	

 $split_words = explode( " " , $fulltext);

#print_r($split_words);

for($i=0; $i<count($split_words);$i++){

	if(strtolower($split_words[$i]) == strtolower($keyword))
	{

		$replaced_string = $replaced_string." "."<span class=\"text_highlighter\">".$split_words[$i]."</span>";
		$highlightersCount++;

	}else{
		$replaced_string = $replaced_string." ".$split_words[$i];
	}


}

#echo $replaced_string;
	$arrayRet[0] = $highlightersCount; # Store 
	$arrayRet[1] = $replaced_string; # Origin text + highlighter words

	return $arrayRet;




/*
	$search = '/'.$keyword.'/i';
	$highlightersCount = substr_count($fulltext, $keyword);

	if (preg_match($search, $fulltext))
	{
		$fulltext = trim($fulltext);
		$wordLenght = strlen($search); //Longitud de toda la vulgar_word

		# Highlighter keyword
		$replaceWord = "<span class=\"text_highlighter\">".$keyword."</span>";
		$replaced_string = str_replace($keyword,$replaceWord,$fulltext);

		$arrayRet[0] = $highlightersCount; # Store 
		$arrayRet[1] = $replaced_string; # Origin text + highlighter words

		return $arrayRet;
	
	}*/

}
?>