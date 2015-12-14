<?php

/*
 * Describe you custom columns and form items here.
 *
 * There is some simple examples what you can use:
 *
 *		Column::register('customColumn', '\Foo\Bar\MyCustomColumn');
 *
 * 		FormItem::register('customElement', \Foo\Bar\MyCustomElement::class);
 *
 * 		FormItem::register('otherCustomElement', function (\Eloquent $model)
 * 		{
 *			AssetManager::addStyle(URL::asset('css/style-to-include-on-page-with-this-element.css'));
 *			AssetManager::addScript(URL::asset('js/script-to-include-on-page-with-this-element.js'));
 * 			if ($model->exists)
 * 			{
 * 				return 'My edit code.';
 * 			}
 * 			return 'My custom element code';
 * 		});
 */
use SleepingOwl\Admin\Columns\Column\BaseColumn;

class LinkColumn extends BaseColumn
{

    

    public function render($instance, $totalCount)
    {
        $content = $instance->codigo;
        return '<td><a href="/orden?codigo=' . $content . '" target="_blank">Link</a></td>';
    }

}

Column::register('Link', 'LinkColumn');

FormItem::register('archivosSelector', function (\Eloquent $model)
  		{
 			$archivos = Storage::directories('archivos-imprentas');

 			$archivos_seleccionados = explode(",", $model->archivos);

 			
 			$salida = '<div class="form-group"><label for="archivos_s">Archivos</label><div>
 					<select class=" multiselect form-control" size="2" data-select-type="multiple" multiple="multiple" id="archivos_s[]" name="archivos_s">
 					';
 			foreach($archivos as $archivo){
 				$archivo = str_replace('archivos-imprentas/','',$archivo);
 				$sel = (in_array($archivo, $archivos_seleccionados))?' selected="selected" ':'';
 				$salida .= '<option '.$sel.'>'.$archivo.'</option>';
 			}

			$salida .= '</select></div></div>';
			return $salida;
  		});
FormItem::register('archivosHidden', function (\Eloquent $model)
  		{
 			AssetManager::addScript(URL::asset('js/archivos.js'));
			return '<input type="hidden" name="archivos" id="archivos" value="'.$model->archivos.'">';
  		});
