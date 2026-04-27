<?php

/**
 *
 */
class MyHtml extends CHtml
{
	public static function script($text,array $htmlOptions=[])
	{
		$defaultHtmlOptions=[
		];
		$htmlOptions=array_merge($defaultHtmlOptions,$htmlOptions);
		return self::tag('script',$htmlOptions,"\n/*<![CDATA[*/\n{$text}\n/*]]>*/\n");
	}

	/**
	 * Includes a JavaScript file.
	 * @param string $url URL for the JavaScript file
	 * @param array $htmlOptions additional HTML attributes (see {@link tag})
	 * @return string the JavaScript file tag
	 */
	public static function scriptFile($url,array $htmlOptions=[])
	{
		$defaultHtmlOptions=[
			'src'=>$url
		];
		$htmlOptions=array_merge($defaultHtmlOptions,$htmlOptions);
		return self::tag('script',$htmlOptions,'');
	}

	public static function radioButtonList($name,$select,$data,$htmlOptions=[])
	{
		$template=isset($htmlOptions['template'])?$htmlOptions['template']:'{input} {label}';
		$separator=isset($htmlOptions['separator'])?$htmlOptions['separator']:self::tag('br');
		$container=isset($htmlOptions['container'])?$htmlOptions['container']:'span';
		$itemOptions=isset($htmlOptions['itemOptions'])?$htmlOptions['itemOptions']:[];
		unset($htmlOptions['template'],$htmlOptions['separator'],$htmlOptions['container'], $htmlOptions['itemOptions']);

		$labelOptions=isset($htmlOptions['labelOptions'])?$htmlOptions['labelOptions']:[];
		unset($htmlOptions['labelOptions']);

		if(isset($htmlOptions['empty']))
		{
			if(!is_array($htmlOptions['empty']))
				$htmlOptions['empty']=[''=>$htmlOptions['empty']];
			$data=CMap::mergeArray($htmlOptions['empty'],$data);
			unset($htmlOptions['empty']);
		}

		$items=[];
		$baseID=isset($htmlOptions['baseID']) ? $htmlOptions['baseID'] : self::getIdByName($name);
		unset($htmlOptions['baseID']);
		$id=0;
		foreach($data as $value=>$labelTitle)
		{
			$itemOption=isset($itemOptions[$value])?$itemOptions[$value]:[];
			$checked='';
			$htmlOptions['value']=$value;
			$htmlOptions['id']=$baseID.'_'.$id++;
			$option=self::radioButton($name,$checked,$htmlOptions+$itemOption);
			$beginLabel=self::openTag('label',$labelOptions);
			$label=self::label($labelTitle,$htmlOptions['id'],$labelOptions);
			$endLabel=self::closeTag('label');
			$items[]=strtr($template,[
				'{input}'=>$option,
				'{beginLabel}'=>$beginLabel,
				'{label}'=>$label,
				'{labelTitle}'=>$labelTitle,
				'{endLabel}'=>$endLabel,
			]);
		}
		if(empty($container))
			return implode($separator,$items);
		else
			return self::tag($container,['id'=>$baseID],implode($separator,$items));
	}
}