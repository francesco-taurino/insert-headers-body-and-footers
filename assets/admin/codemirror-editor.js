/**
 * Insert Headers, Body and Footers
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2020, Francesco Taurino
 * @license     https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
jQuery( document ).ready(function($) 
{
	var myModeSpec = {
		name: "htmlmixed",
		lineNumbers: true,	
		// In post edit https://github.com/codemirror/CodeMirror/issues/3098
		lineWrapping : false,
		//autoRefresh:true,
		styleActiveLine: true,
		lint:true, 
		//htmlMode: false,
	 	tags: {
			style: [["type", /^text\/(x-)?scss$/, "text/x-scss"],
			        [null, null, "css"]],
			custom: [[null, null, "customMode"]]
		}
	}

	cm1 = CodeMirror.fromTextArea( document.getElementById('_ihbaf_header'), myModeSpec);
	cm2 = CodeMirror.fromTextArea(document.getElementById('_ihbaf_body'), myModeSpec);
	cm3 = CodeMirror.fromTextArea(document.getElementById('_ihbaf_footer'), myModeSpec);
});