{include file="header.tpl"}
{if $is_login eq "true"}{include file="admin.tpl"}
{include file="forms.tpl"}
{else}{include file="login.tpl"}
{/if}
{include file="footer.tpl"}