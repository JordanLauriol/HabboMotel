<?php
return [
    'input' => '<input class="input" type="{{type}}" name="{{name}}"{{attrs}}/>',
    'inputContainer' => '<p class="control {{has_icon}}">{{content}}<span class="help">{{help}}</span><span class="icon is-small is-left" style="display:{{display_icon}}"><i class="fa fa-{{icon}}"></i></span></p>',
    'inputContainerError' => '{{content}}<p style="color: #ff3860;"><span class="icon is-small"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span> {{error}}</p>',
    'select' => '<span class="select"><select name="{{name}}"{{attrs}}>{{content}}</select></span>',
    'error' => '{{content}}',
    'radio' => '<div style="margin-left:10px; display: inline-block; padding: 5px; 0px 0px 0px;"><input type="radio" name="{{name}}" value="{{value}}"{{attrs}}></div>',
	'radioWrapper' => '<div>{{label}}</div>'
];
