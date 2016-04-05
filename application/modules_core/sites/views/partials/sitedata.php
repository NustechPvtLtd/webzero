<style>
    .disabled {
        cursor: not-allowed;
    }

</style>

<div id="siteSettingsWrapper" class="siteSettingsWrapper">
    <div class="col-sm-12">
        <div class="panel panel-default" id="freeUrlOptionPane">
            <div class="panel-heading">
				<div class="row">
					<div class="col-sm-10">
						<label>Free Url</label>
					</div>
					<div class="col-sm-2">
                        <input type="radio" name="radio1" <?php echo ((isset($domains['freeUrl']) && $domains['freeUrl']['active']) || empty($domains)) ? 'checked' : ''; ?> class="switch-radio1 pull-right" value="freeUrl">
					</div>
				</div>
			</div>
			
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="siteSettingsForm">
                    <input type="hidden" name="siteID" id="siteID" value="<?php echo $site->sites_id; ?>">
                    <div class="form-group">
                        <label class="col-sm-3">Set Free URL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="siteSettings_domain" name="siteSettings_domain" placeholder="<?php echo $this->lang->line('sitedata_label_domain_placeholder') ?>" value="<?php echo (isset($domains['freeUrl']) && !empty($domains['freeUrl']['domain'])) ? $domains['freeUrl']['domain'] : ''; ?>" <?php echo (isset($domains['freeUrl']) && !empty($domains['freeUrl']['domain'])) ? 'readonly=""' : ''; ?>>
                            <div class="clearfix"><!--Clear Div--></div>
                            <span id="publicURL"><?php echo (isset($domains['freeUrl']) && !empty($domains['freeUrl']['domain'])) ? 'Your web site url: '.anchor(base_url($domains['freeUrl']['domain']), base_url($domains['freeUrl']['domain']), array('target'=>'_blank')) : ''; ?></span>
                        </div>
                    </div>
                </form>
				<div class="pull-right">
					<button type="button" class="btn btn-primary btn-embossed" id="saveSiteSettingsButton"><span class="fui-check"></span> <?php echo $this->lang->line('sitesettings_button_savesettings') ?></button>
				</div>
            </div>
            
        </div>
    </div>

    <div class="clearfix"><!--clear Div--></div>
    <div class="col-sm-12">
        <div class="panel panel-default" id="addDomainOptionPane">
            <div class="panel-heading">
				<div class="row">
					<div class="col-sm-10">
						<label>Add Your Personal Domain</label>
					</div>
					<div class="col-sm-2">
						<input type="radio" name="radio1" <?php echo (isset($domains['addonDomain']) && $domains['addonDomain']['active']) ? 'checked' : ''; ?> class="switch-radio1" value="addonDomain">
					</div>
				</div>
			</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="addDomainForm" action="<?php echo site_url('domain/add_domain/' . $site->sites_id); ?>">
                    <div class="form-group">
                        <label class="col-sm-3">Your Domain Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="siteSettings_adddomain" name="siteSettings_adddomain" placeholder="example.com" value="<?php echo (isset($domains['addonDomain']) && !empty($domains['addonDomain']['domain'])) ? $domains['addonDomain']['domain'] : ''; ?>" <?php echo (isset($domains['addonDomain']) && !empty($domains['addonDomain']['domain'])) ? 'readonly=""' : ''; ?>>
                            <div class="clearfix"><!--Clear Div--></div>
                            <span id="addonDomainURL"><?php echo (isset($domains['addonDomain']) && !empty($domains['addonDomain']['domain'])) ? 'Your web site url: '. anchor('http://' . $domains['addonDomain']['domain'] , 'http://' . $domains['addonDomain']['domain'] , array("target"=>"_blank")): ''; ?></span>
                            <span style="color:red;"><label>Make Sure your Domain is set at  our DNS Server Name: ns1.artwork.mysitehosted.com and ns2.artwork.mysitehosted.com</label></span>
                        </div>
                    </div>
                </form>
				<div class="pull-right">
					<button type="button" class="btn btn-primary btn-embossed" id="addDomainButton"><span class="fui-check"></span> <?php echo 'Add your domain' ?></button>
				</div>
            </div>
        </div>
    </div>
    
    <div class="clearfix"><!--clear Div--></div>
    <div class="col-sm-12">
        <div class="panel panel-default" id="premiumDomainOptionPane">
            <div class="panel-heading">
				<div class="row">
					<div class="col-sm-10">
						<label>Search Your Domain Name</label>
					</div>
					<div class="col-sm-2">
						<input type="radio" name="radio1" <?php echo (isset($domains['premiumDomain']) && $domains['premiumDomain']['active']) ? 'checked' : ''; ?> class="switch-radio1" value="premiumDomain">
					</div>
				</div>
			</div>
            <div class="panel-body">
                <div class="product-purchased" id="domain-name">
                    <form class="form-horizontal" method="POST" name="quickbuy_domain" id="select-product" novalidate="novalidate">
                        <div id="loader" style="display: none">
                            <span>
                                <img src="<?php echo base_url('assets/sites'); ?>/images/loading.gif" alt="Loading...">
                                Jadooweb builder...
                            </span>
                        </div>
                        <input type="hidden" name="siteID" id="siteID" value="<?php echo $site->sites_id; ?>">
                        <input type="hidden" value="check_availability" name="action">
                        <div class="dca-search form-group">
                            <label class="col-sm-3">Find Domain Name</label>
                            <div class="col-sm-5">
                                <input type="text" required="" placeholder="Enter Keywords or Domain Names" id="domainname" name="domainname" autocomplete="off" class="form-control" value="<?php echo (isset($domains['premiumDomain']) && !empty($domains['premiumDomain']['domain'])) ? $domains['premiumDomain']['domain'] : ''; ?>" <?php echo (isset($domains['premiumDomain']) && !empty($domains['premiumDomain']['domain'])) ? 'readonly=""' : ''; ?>>
                                <span id="remoteURL"><?php echo (isset($domains['premiumDomain']) && !empty($domains['premiumDomain']['domain'])) ? 'Your web site url: '.  anchor('http://' . $domains['premiumDomain']['domain'], 'http://' . $domains['premiumDomain']['domain'], array("target"=>"_blank")) : ''; ?></span>
                            </div>
                            <div class="col-sm-4">
								<button type="button" class="btn btn-primary btn-embossed col-sm-12" name="btn_check_availability" id="btn_check_availability">
                                Search Subscribed Domain
								</button>
							</div>
                            <div class="clearfix"></div>

                            <div class="tld-container col-sm-12">
                                <div class="tld-container-primary" >
                                    <span class="inline-block col-1"><input type="checkbox" value="info" id="info" name="tlds[]" ><label class="inline-block" for="info">info</label></span>
                                    <span class="inline-block col-1"><input type="checkbox" value="in" id="in" name="tlds[]" ><label class="inline-block" for="in">in</label></span>
                                    <span class="inline-block col-1"><input type="checkbox" value="co.in" id="co.in" name="tlds[]" ><label class="inline-block" for="co.in">co.in</label></span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="domain_result" class="results-wrapper" style="display: none">
                        <h6>Search Results <span id="plan_error" class="error hide">Please select a domain name</span></h6>
                        <form method="POST" name="buy_domain" id="book-domain-form" novalidate="novalidate" action="<?php echo site_url('domain/bookDomain/' . $site->sites_id); ?>">
                            <div class="search-results-container table-responsive">

                            </div>
                        </form>
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-embossed" id="domainSubmittButton" disabled="disabled"><span class="fui-check"></span> <?php echo 'Use This Domain';//$this->lang->line('domainSubmittButton') ?></button>
						</div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"><!--clear Div--></div>
    <?php if(isset($domains['paidDomain'])): ?>
    <div class="col-sm-12">
        <div class="panel panel-default" id="paidDomainOptionPane">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-10">
                        <label>Add Your Paid Domain</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="radio" name="radio1" <?php echo (isset($domains['paidDomain']) && $domains['paidDomain']['active']) ? 'checked' : ''; ?> class="switch-radio1" value="paidDomain">
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="paidDomainForm" action="<?php echo site_url('domain/add_paid_doamin/' . $site->sites_id); ?>">
                    <div class="form-group">
                        <label class="col-sm-3">Your Domain Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="siteSettings_paiddomain" name="siteSettings_paiddomain" placeholder="example.com" value="<?php echo (isset($domains['paidDomain']) && !empty($domains['paidDomain']['domain'])) ? $domains['paidDomain']['domain'] : ''; ?>" <?php echo (isset($domains['paidDomain']) && !empty($domains['paidDomain']['domain'])) ? 'readonly=""' : ''; ?>>
                            <div class="clearfix"><!--Clear Div--></div>
                            <span id="addonDomainURL"><?php echo (isset($domains['paidDomain']) && !empty($domains['paidDomain']['domain'])) ? 'Your web site url: ' . anchor('http://' . $domains['paidDomain']['domain'], 'http://' . $domains['paidDomain']['domain'], array("target" => "_blank")) : ''; ?></span>
    
                        </div>
                    </div>
                </form>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-embossed" id="addpaidDomainButton" ><span class="fui-check"></span> <?php echo 'Add your domain' ?></button>
                </div>
            </div>
        </div>
    </div>    
    <div class="clearfix"><!--clear Div--></div>
    <?php endif;?>
</div>
<!---->


<script>
    $(document).ready(function() {
        
        $("[name='radio1']").bootstrapSwitch();

        $('#siteSettings_domain').keyup(function(e) {
            if ($(this).prop("readonly")) {
                e.preventDefault();
                return false;
            }
            if (/^[a-z0-9]{3,}$/i.test($(this).val())) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('sites/checkDomain') ?>",
                    data: {domain: $(this).val().toLowerCase()},
                    success: function(res) {
                        if (res.error == 0) {
                            $('#publicURL').text(res.errorMessage).css('color', 'green');
                        }
                        if (res.error == 1) {
                            $('#publicURL').text(res.errorMessage).css('color', 'red');
                        }
                    },
                    dataType: "JSON",
                    async: false
                });
            } else {
                $('#publicURL').text('Domain names must have minimum 3 letters and can not have symbols.').css('color', 'red');
            }
        });

        jQuery.validator.addMethod("regx", function(value, element, regexpr) {
            return regexpr.test(value);
        }, "Please enter a valid domain name.");

        $('#select-product').validate({
            rules: {
                domainname: {
                    required: true,
                    minlength: 3,
                    regx: /^[a-z0-9]+[a-z0-9-]+[a-z0-9]+$/
                }
            },
            messages: {
                domainname: {
                    required: "Please enter domain name to search!",
                    minlength: "At least {0} characters required!",
                    regx: "Only alphanumeric and hyphons(-) are allowed. Hyphons should not be on first or end place!"
                }
            }
        });

        $('#btn_check_availability').click(function() {
            $('#loader').show();
            var checked = false;
            if ($("#select-product").valid()) {
                $('.tld-container input[type=checkbox]').each(function() {
                    if ($(this).is(":checked")) {
                        checked = true;
                    }
                });
                if (!checked) {
                    $('.tld-container-primary input[type=checkbox]').each(function() {
                        $(this).prop("checked", true);
                    });
                }
                $.ajax({
                    url: "<?php echo site_url('domain/checkDomainAvalability') ?>",
                    type: 'post',
                    data: $('#select-product').serialize(),
                    success: function(ret) {
                        $('#loader').hide();
                        $('.search-results-container').html(ret);
                        $('#domain_result').show();
                        $('#domainSubmittButton').removeAttr('disabled');
                    }
                });
            }
        });
        $('input[name="radio1"]').on('switchChange.bootstrapSwitch', function(event, state) {
            urlOption = $(this).val();
            if(plan=='1' && urlOption!="freeUrl"){
                var upgradAccount = window.confirm("Please upgrade your accout to avail this facility.?\nPress OK to upgrade or Press Cancel to continue with Free Url!");
                $(this).bootstrapSwitch('state', false);
                $('input[value="freeUrl"]').bootstrapSwitch('state', true);
                if(upgradAccount){
                    window.location = '<?php echo site_url("account/plans");?>';
                }
            }else{
                disable($(this).val());
            }
        });

        $('#addDomainButton').on('click', function() {
            //show loader, hide rest
            $('#siteSettingsWrapper .loader').show();
            $('#siteSettingsWrapper > *:not(.loader)').hide();

            $.ajax({
                url: $('#addDomainForm').attr('action'),
                type: 'POST',
                data: $('#addDomainForm').serialize(),
                dataType: 'json',
                success: function(res) {
                    $('#siteSettings .loader').fadeOut(500, function() {
                        $('#siteSettings .modal-body-content > *').each(function() {
                            $(this).remove();
                        });
                        $('#siteSettings .modal-body-content').append($(res.responseHTML));
                    });
                    $("#confirmPublish").modal('show');
                    $("#siteSettings").modal('hide');
                }
            });
        });
        $('#addpaidDomainButton').on('click', function() {
            //show loader, hide rest
            $('#siteSettingsWrapper .loader').show();
            $('#siteSettingsWrapper > *:not(.loader)').hide();

            $.ajax({
                url: $('#paidDomainForm').attr('action'),
                type: 'POST',
                data: $('#paidDomainForm').serialize(),
                dataType: 'json',
                success: function(res) {
                    $('#siteSettings .loader').fadeOut(500, function() {
                        $('#siteSettings .modal-body-content > *').each(function() {
                            $(this).remove();
                        });
                        $('#siteSettings .modal-body-content').append($(res.responseHTML));
                    });
                }
            });
        });

        //site name input field
        $('button#saveSiteSettingsButton').click(function() {
            if (/^[a-z0-9]{3,}$/i.test($('#siteSettings_domain').val())) {
                //destroy all alerts
                $('#siteSettings .alert').fadeOut(500, function() {
                    $(this).remove();
                });

                //disable button
                $('#saveSiteSettingsButton').addClass('disabled');

                //hide form data
                $('#siteSettings .modal-body-content > *').hide();

                //show loader
                $('#siteSettings .loader').show();

                $.ajax({
                    url: '<?php echo site_url('sites/siteAjaxUpdate') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: $('form#siteSettingsForm').serializeArray()
                }).done(function(ret) {

                    if (ret.responseCode == 0) {//error

                        $('#siteSettings .loader').fadeOut(500, function() {

                            $('#siteSettings .modal-alerts').append(ret.responseHTML);

                            //show form data
                            $('#siteSettings .modal-body-content > *').show();

                            //enable button
                            $('#saveSiteSettingsButton').removeClass('disabled');

                        });
                        domain_ok = "0";
                    } else if (ret.responseCode == 1) {//all is well

                        $('#siteSettings .loader').fadeOut(500, function() {

                            //update site name in top menu
                            //$('#siteTitle').text( ret.siteName );

                            $('#siteSettings .modal-alerts').append(ret.responseHTML);

                            //hide form data
                            $('#siteSettings .modal-body-content > *').remove();
                            $('#siteSettings .modal-body-content').append(ret.responseHTML2);

                            //enable button
                            $('#saveSiteSettingsButton').removeClass('disabled');

                            //is the FTP stuff all good?

                            if (ret.domainOk == 1) {//yes, all good

                                $('#publishPage').removeAttr('data-toggle');
                                $('#publishPage span.text-danger').hide();

                                $('#publishPage').tooltip('destroy');
                                domain_ok = "1";
                            } else {//nope, can't use FTP

                                $('#publishPage').attr('data-toggle', 'tooltip');
                                $('#publishPage span.text-danger').show();

                                $('#publishPage').tooltip('show');
                                domain_ok = "0";
                            }

                            if ($("input:radio[name='domain']").is(':checked')) {
                                $.ajax({
                                    url: $('form#book-domain-form').attr('action'),
                                    type: 'post',
                                    data: $('form#book-domain-form').serialize()
                                }).done(function(ret) {
                                    $('.search-results-container').html(' ');
                                    $('.search-results-container').html(ret);
                                    $('#domain_result').show();
                                });
                            }
                        });
                        $("#confirmPublish").modal('show');
                        $("#siteSettings").modal('hide');
                    }

                });
            } else {
                $('#publicURL').text('Domain names can only contain letters and numbers').css('color', 'red');
            }
        });
        $('#domainSubmittButton').click(function() {
                        $("#confirmPublish").modal('show');
                        $("#siteSettings").modal('hide');
//            alert("click");
            if ($("input:radio[name='domain']").is(':checked')) {
                $.ajax({
                    url: $('form#book-domain-form').attr('action'),
                    type: 'post',
                    data: $('form#book-domain-form').serialize()
                }).done(function(ret) {
                    $('.search-results-container').html(' ');
                    $('.search-results-container').html(ret);
                    $('#domain_result').show();
                    $('#domainSubmittButton').attr('disabled', 'disabled');
                });
            } else {
                alert('Please select domain!');
            }
        });
    });

    disable('<?php echo (isset($domains['premiumDomain']) && $domains['premiumDomain']['active']) ? 'premiumDomain' : (isset($domains['addonDomain']) && $domains['addonDomain']['active']) ? 'addonDomain' : (isset($domains['paidDomain']) && $domains['paidDomain']['active']) ? 'paidDomain' : 'freeUrl'; ?>');
    function disable(url_option) {
        if (url_option == 'freeUrl') {
            $("#freeUrlOptionPane :input").attr("disabled", false);
            $("#addDomainOptionPane :input").attr("disabled", true);
            $("#premiumDomainOptionPane :input").attr("disabled", true);
            $("paidDomainOptionPane:input").attr("disabled", true);
            $("#freeUrlOptionPane").removeClass('disabled');
            $("#addDomainOptionPane").addClass('disabled');
            $("#premiumDomainOptionPane").addClass('disabled');
            $("#paidDomainOptionPane").addClass('disabled');
            $('#addpaidDomainButton').addClass('disabled');
        } else if (url_option == 'addonDomain') {
                $("#freeUrlOptionPane :input").attr("disabled", true);
                $("#addDomainOptionPane :input").attr("disabled", false);
                $("#premiumDomainOptionPane :input").attr("disabled", true);
            $("paidDomainOptionPane:input").attr("disabled", true);
            
                $("#freeUrlOptionPane").addClass('disabled');
                $("#addDomainOptionPane").removeClass('disabled');
                $("#premiumDomainOptionPane").addClass('disabled');
            $("#paidDomainOptionPane").addClass('disabled');
        } else if (url_option == 'paidDomain') {
            $("#freeUrlOptionPane :input").attr("disabled", true);
            $("#addDomainOptionPane :input").attr("disabled", true);
            $("#premiumDomainOptionPane :input").attr("disabled", true);
            $("paidDomainOptionPane:input").attr("disabled", false);            
            $("#freeUrlOptionPane").addClass('disabled');
            $("#addDomainOptionPane").addClass('disabled');
            $("#premiumDomainOptionPane").addClass('disabled');
            $("#paidDomainOptionPane").removeClass('disabled');
            $('#addpaidDomainButton').removeClass('disabled');
        }
        else {
            $("#freeUrlOptionPane :input").attr("disabled", true);
            $("#addDomainOptionPane :input").attr("disabled", true);
            $("#premiumDomainOptionPane :input").attr("disabled", false);
            $("paidDomainOptionPane:input").attr("disabled", true);           
            $("#freeUrlOptionPane").addClass('disabled');
            $("#addDomainOptionPane").addClass('disabled');
            $("#premiumDomainOptionPane").removeClass('disabled');
            $("#paidDomainOptionPane").addClass('disabled');
        }
    }
</script>
