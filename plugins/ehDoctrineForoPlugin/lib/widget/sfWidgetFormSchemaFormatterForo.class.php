<?php
class sfWidgetFormSchemaFormatterForo extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<li class=\"eh_foro_field\">\n <div class=\"eh_foro_label\">%label%\n%help%</div>\n %field%\n %error%\n %hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<div class="eh_foro_help">%help%</div>',
    $decoratorFormat = "<ul>\n  %content%</ul>";
}
