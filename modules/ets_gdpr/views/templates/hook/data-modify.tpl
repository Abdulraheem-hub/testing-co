{*
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
*}
{if isset($details) && $details}
    <ol class="gdpr_data_modify">
    {foreach from=$details key='key' item='detail'}
        <li class="gdpr_data_item">{$detail.label|escape:'html':'utf-8'}: <strong>{if $key=='birthday'}{dateFormat date=$detail.$key full=0}{else}{$detail.$key nofilter}{/if}</strong></li>
    {/foreach}
    </ol>
{/if}