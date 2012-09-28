<?php
class sfWidgetFormSchemaFormatterTemplo extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<li class=\"tdh_campo\">\n <div class=\"tdh_label\">%label%\n%help%</div>\n %field%\n %error%\n %hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<div class="tdh_help">%help%</div>',
    $decoratorFormat = "<ul>\n  %content%</ul>";
}
