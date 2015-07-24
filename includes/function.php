<?php
/*
PHP - Highlighter Text 
Date: 2015-07-23
By: Engineer, Web Developer Gregory Hidalgo Ramírez
Websites:
- www.gregoryhidalgo.com
- www.valoresweb.com
GitHub:  @ghidalgor | Twitter: @websoundcr
Please, refer me :-);
*/

function text_highlighter($originText, $keymatch){

#--Variables
$keywordSize = 0;
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
				if(($keywordSize-1) == $keywordPos)
				{							
					$finalText = $finalText."<span class=\"text_highlighter\">".$keyTemp."</span>";
					$keyTemp = "";
					$keywordPos = 0;
				}

				/* Ex: If $keyword contain "abc" characters. 
					$keywordSize is equal to 3 and most value for $keywordPos will be 2. The next "if" avoid technical problems.
				*/
				if(($keywordPos+1) < $keywordSize){
					$keywordPos++;
				}
				

			}else{
					if($keywordPos>0)
					{
						$finalText = $finalText.$keyTemp;
						$keyTemp = null;
					}

					$keywordPos = 0;
					$finalText = $finalText.$allText[$pos];
			}

		}#for

		echo $finalText;
}


}

#This function is when word has "tíldes"(spanish).
#For example: "canción" is equal to "cancion", The only different is "ó" and "o". Function "extraCharacters()" to help fix this issue.
function extraCharacters($character){
	$found = null;

	#CONST
    $convert_to   = array('Á','É','Í','Ó','Ú','Ñ','á','é','í','ó','ú','ñ','a','e','i','o','u');
    $convert_from = array('A','E','I','O','U','N','a','e','i','o','u','n','á','é','í','ó','ú');

    for($pos=0; $pos<count($convert_to); $pos++)
    {
 		if (strcmp(mb_substr($character,0,1,'UTF-8'), mb_substr($convert_to[$pos],0,1,'UTF-8')) == 0)	{
    		$found = $convert_from[$pos];
		}

    }#For

	return $found;
}

function captureCharacter($textChain)
{
	$arrData = array();

	for ($position = 0, $textLen = mb_strlen($textChain,'UTF-8'); $position < $textLen; $position++)
	{
        $arrData[] = mb_substr($textChain,$position,1,'UTF-8');
	}

	//http://blog.openalfa.com/como-trabajar-con-cadenas-de-texto-en-php
	return $arrData;
}



#This function compare word by word. I'ts 70% of effective.
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
}
?>