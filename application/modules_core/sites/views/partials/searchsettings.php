<div class="optionPane">
    <div class="notification_msg"></div>
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#basic" data-toggle="tab" class="basic">Basic Details</a></li>
        <li><a href="#Education" data-toggle="tab" class="edu">Education</a></li>
        <li><a href="#skill" data-toggle="tab" class="skill">Skills</a></li>
        <li><a href="#language" class="language" data-toggle="tab">Languages</a></li>
    </ul>
    <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="basic">
            <!-- BASIC DETAILS OF STUDENT -->
            <form class="form-horizontal" role="form" id="pageResumeBasics" action="#">
                <input type="hidden" name="siteID" id="siteID" value="<?php echo $siteData->sites_id ?>">
                <input type="hidden" name="pageID" id="pageID" value="<?php if (isset($pagesData['index'])) {
    echo $pagesData['index']->pages_id;
} ?>">
                <input type="hidden" name="resume" value="basic"/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6" >
                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Resume Title"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                                <input type="text" class="form-control" id="r_title" name="r_title" placeholder="Resume Title" value="<?php if (isset($resumeData['basic'])) {
    echo $resumeData['basic']->resume_headline;
} ?>">
                            </div>

                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Resume Description"; //echo $this->lang->line('modal_pagesettings_pagedescription') ?>:</label>
                                <textarea class="form-control" id="r_desc" name="r_desc" placeholder="Resume Description"><?php if (isset($resumeData['basic'])) {
    echo $resumeData['basic']->summery;
} ?></textarea>
                            </div>

                            <div class="form-group col-sm-11">
                                <label for="name" class=" control-label"><?php echo "Company/Organization"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                                <input type="text" class="form-control" id="r_company" name="r_company" placeholder="Company/Organization Name" value="<?php if (isset($resumeData['basic'])) {
    echo $resumeData['basic']->company;
} ?>">
                            </div>		

                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Current Job Role"; //echo $this->lang->line('modal_pagesettings_pagetitle')?>:</label>
                                <input type="text" class="form-control" id="r_role" name="r_role" placeholder="Current Role" value="<?php if (isset($resumeData['basic'])) {
                                    echo $resumeData['basic']->role;
                                } ?>">
                            </div>

                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Notice Period"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                                    <?php
                                    $notice_period = array(
                                        "0" => "< Than Month",
                                        "1" => "1 Month",
                                        "2" => "2 Month",
                                        "3" => "3 Month",
                                        "4" => "More Than 3 Month"
                                    );
                                    ?>
                                <select name="r_notice_p" class="form-control">
<?PHP foreach ($notice_period as $k => $v): ?>
                                        <option value="<?PHP echo $k; ?>" <?php if (isset($resumeData['basic'])) {
        echo ($resumeData['basic']->notice_period == $k) ? " selected" : " ";
    } ?>><?PHP echo $v; ?></option>
<?PHP endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Current Location"; //echo $this->lang->line('modal_pagesettings_pagetitle')?>:</label>
                                <input type="text" class="form-control" id="r_clocaltion" name="r_clocaltion" placeholder="Current Location" value="<?php if (isset($resumeData['basic'])) {
                                echo $resumeData['basic']->location;
                            } ?>">
                            </div>

                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Preferred Location (Max 3)"; //echo $this->lang->line('modal_pagesettings_pagetitle')?>:</label>
                                <input type="text" class="form-control" id="r_plocation" name="r_plocation" placeholder="Preferred Location" value="<?php if (isset($resumeData['basic'])) {
                                echo $resumeData['basic']->preff_location;
                            } ?>">
                            </div>		
                            <?PHP
                            $salary_scale = array(
                                "0" => "< 1 Lakh",
                                "1" => "1 to 2 Lakh",
                                "2" => "2 to 3 Lakh",
                                "3" => "3 to 4 Lakh",
                                "4" => "4 to 5 Lakh",
                                "5" => "5 to 6 Lakh",
                                "6" => "6 to 7 Lakh",
                                "7" => "7 to 8 Lakh",
                                "8" => "8 to 9 Lakh",
                                "9" => "9 to 10 Lakh",
                                "10" => "10 to 11 Lakh",
                                "11" => "12+ Lakh"
                            );
                            ?>
                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Current CTC (Annual)"; //echo $this->lang->line('modal_pagesettings_pagetitle')?>:</label>
                                <select name="cctc" class="form-control">
<?PHP if (isset($salary_scale)): ?>
    <?PHP foreach ($salary_scale as $k => $v): ?>
                                            <option value="<?PHP echo $k; ?>" <?php if (isset($resumeData['basic'])) {
            echo (isset($resumeData['basic']->salary) && $resumeData['basic']->salary == $k) ? " selected" : " ";
        } ?>><?PHP echo $v; ?></option>
    <?PHP endforeach; ?>
<?PHP endif; ?>
                                </select>
                            </div>

                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Expected CTC (Annual)"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                                <select name="ectc" class="form-control">
<?PHP foreach ($salary_scale as $k => $v): ?>
                                        <option value="<?PHP echo $k; ?>" <?php if (isset($resumeData['basic'])) {
        echo ($resumeData['basic']->expected_salary == $k) ? " selected" : " ";
    } ?>><?PHP echo $v; ?></option>
<?PHP endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-sm-11">
                                <label for="name" class="control-label"><?php echo "Total Experience (In Months)"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                                <input type="number" min="0" class="form-control" id="r_tot_exp" name="r_tot_exp" placeholder="Total Experience" value="<?php if (isset($resumeData['basic'])) {
    echo $resumeData['basic']->total_exp;
} ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="modal-footer modal-footer-btn">
                            <button type="button" class="btn btn-primary btn-embossed" id="saveBasicDetails"><span class="fui-check"></span> <?php echo "Save & Next"; //echo $this->lang->line('sitesettings_button_savesettings')  ?></button>
                        </div>			
                    </div>
                </div>
            </form>

        </div>

        <div class="tab-pane" id="Education">
            <!-- Student Education -->
            <form class="form-horizontal" role="form" id="pageResumeEducation" action="#">
                <input type="hidden" name="siteID" id="siteID" value="<?php echo $siteData->sites_id ?>">
                <input type="hidden" name="pageID" id="pageID" value="<?php if (isset($pagesData['index'])) {
    echo $pagesData['index']->pages_id;
} ?>">
                <input type="hidden" name="resume" value="education"/>
                <div class="row">
                    <div class="col-sm-12 inputpanel">
                        <div class="col-sm-6">
                            <label for="name" class="control-label"><?php echo "Certificate/Degree"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                            <input type="text" class="form-control" name="degree" value="" placeHolder="Certificate/Degree"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><?php echo "Start Year"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                            <select name="syear"  class="form-control">
<?PHP for ($i = date("Y"); $i >= 1990; $i--) : ?>
                                    <option value="<?PHP echo $i; ?>"><?PHP echo $i; ?></option>
<?PHP endfor; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><?php echo "End Year"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                            <select name="eyear"  class="form-control">
<?PHP for ($i = date("Y"); $i >= 1990; $i--) : ?>
                                    <option value="<?PHP echo $i; ?>"><?PHP echo $i; ?></option>
<?PHP endfor; ?>
                            </select>
                        </div>			
                    </div>
                    <div class="col-sm-12 inputpanel">
                        <div class="col-sm-6">
                            <label for="name" class="control-label"><?php echo "Institute Name"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                            <input type="text" class="form-control" name="institute" value="" placeHolder="Institute Name"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><?php echo "Percentage/Grade"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                            <input type="text" class="form-control" name="per" value="" placeHolder="Percentage/Grade"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label">&nbsp;<?php echo ""; //echo $this->lang->line('modal_pagesettings_pagetitle')?></label>
                            <button type="button" class="btn btn-primary btn-embossed pull-right" id="addEducation"><?php echo " Add "; //echo $this->lang->line('sitesettings_button_savesettings') ?></button>
                        </div>
                    </div>

                    <div class="col-sm-12 title">
                        <div class="col-sm-2">
                            <label for="name" class="control-label"><b><?php echo "Certificate/Degree"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                        <div class="col-sm-4">
                            <label for="name" class="control-label"><b><?php echo "Institute Name"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                        <div class="col-sm-2">
                            <label for="name" class="control-label"><b><?php echo "Year"; //echo $this->lang->line('modal_pagesettings_pagetitle')?></b></label>
                        </div>
                        <div class="col-sm-2">
                            <label for="name" class="control-label"><b><?php echo "Percentage/Grade"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                        <div class="col-sm-2">
                            <label for="name" class="control-label"><b><?php echo "Action"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                    </div>
                    <div class="myeducation">
<?PHP
if (isset($resumeData['education']) && count($resumeData['education']) > 0) :
    foreach ($resumeData['education'] as $edu):
        ?>
                                <div class="col-sm-12">
                                    <div class="col-sm-2"><?PHP echo $edu->degree; ?></div>
                                    <div class="col-sm-4"><?PHP echo $edu->school; ?></div>
                                    <div class="col-sm-2"><?PHP echo $edu->from_date; ?>-<?PHP echo $edu->to_date; ?></div>
                                    <div class="col-sm-2"><?PHP echo $edu->percentage; ?></div>
                                    <div class="col-sm-2"><button type="button" id="<?PHP echo $edu->id; ?>" class="btn btn-info btn-embossed deleteEducation"><?php echo "X"; //echo $this->lang->line('modal_cancelclose')  ?></button></div>
                                </div>
        <?PHP
    endforeach;
endif;
?>
                    </div>
                    <div class="col-sm-12">
                        <div class="modal-footer modal-footer-btn">
                            <button type="button" class="btn btn-default btn-embossed backeducation"><?php echo "Previous"; //echo $this->lang->line('modal_cancelclose')  ?></button>
                            <button type="button" class="btn btn-primary btn-embossed" id="nextEducation"> <?php echo "Next"; //echo $this->lang->line('sitesettings_button_savesettings')  ?></button>
                        </div>	
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="skill">
            <form class="form-horizontal" role="form" id="pageResumeSkills" action="#">
                <input type="hidden" name="siteID" id="siteID" value="<?php echo $siteData->sites_id ?>">
                <input type="hidden" name="pageID" id="pageID" value="<?php if (isset($pagesData['index'])) {
    echo $pagesData['index']->pages_id;
} ?>">
                <input type="hidden" name="resume" value="skills"/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><?php echo "Skill Name"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                            <input type="text" class="form-control" name="skillname" value="" placeHolder="Skill Name"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><?php echo "Experience"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                            <input type="text" class="form-control" name="experience" value="" placeHolder="Experience"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><?php echo "Ratings"; //echo $this->lang->line('modal_pagesettings_pagetitle')?>:</label>
                            <input type="number" class="form-control" name="rating" value="" placeHolder="Ratings (1 to 10)" min="1" max="10"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label">&nbsp;<?php echo ""; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></label>
                            <button type="button" class="btn btn-primary btn-embossed" id="saveSkills"><?php echo "Add Skill"; //echo $this->lang->line('sitesettings_button_savesettings')  ?></button>
                        </div>
                    </div>
                    <div class="col-sm-12 title">
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><b><?php echo "Skill Name"; //echo $this->lang->line('modal_pagesettings_pagetitle')?></b></label>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><b><?php echo "Experience"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><b><?php echo "Ratings"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                        <div class="col-sm-3">
                            <label for="name" class="control-label"><b><?php echo "Action"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                    </div>
                    <div class="additionalskills">
<?PHP
if (isset($resumeData['skills']) && is_array($resumeData['skills']) && count($resumeData['skills']) > 0):
    foreach ($resumeData['skills'] as $r):
        ?>
                                <div class="col-sm-12">
                                    <div class="col-sm-3"><?PHP echo $r->name; ?></div>
                                    <div class="col-sm-3"><?PHP echo $r->experience; ?></div>
                                    <div class="col-sm-3"><?PHP echo $r->rating; ?></div>
                                    <div class="col-sm-3"><button type="button" id="<?PHP echo $r->id; ?>" class="btn btn-info btn-embossed deleteSkill"><?php echo "X"; //echo $this->lang->line('modal_cancelclose')  ?></button></div>
                                </div>
        <?PHP
    endforeach;
endif;
?>
                    </div>
                    <div class="col-sm-12">
                        <div class="modal-footer modal-footer-btn">
                            <button type="button" class="btn btn-default btn-embossed backskill"><?php echo "Previous"; //echo $this->lang->line('modal_cancelclose')  ?></button>
                            <button type="button" class="btn btn-primary btn-embossed" id="nextSkills"><?php echo "Next"; //echo $this->lang->line('sitesettings_button_savesettings')  ?></button>
                        </div>	
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane" id="language">
            <form class="form-horizontal" role="form" id="pageResumeLanguages" action="#">
                <input type="hidden" name="siteID" id="siteID" value="<?php echo $siteData->sites_id ?>">
                <input type="hidden" name="pageID" id="pageID" value="<?php if (isset($pagesData['index'])) {
    echo $pagesData['index']->pages_id;
} ?>">
                <input type="hidden" name="resume" value="language"/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="name" class="control-label"><?php echo "Language Name"; //echo $this->lang->line('modal_pagesettings_pagetitle')?>:</label>
                            <input type="text" class="form-control" name="languagenm" placeHolder="Language Name"/>
                        </div>
                        <div class="col-sm-4">
                            <label for="name" class="control-label"><?php echo "Ratings"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?>:</label>
                            <input type="number" class="form-control" name="rating" placeHolder="Ratings (1 to 10)" min="1" max="10"/>
                        </div>
                        <div class="col-sm-4">
                            <label for="name" class="control-label">&nbsp;<?php echo " "; //echo $this->lang->line('modal_pagesettings_pagetitle')?></label>
                            <button type="button" class="btn btn-primary btn-embossed" id="saveLanguages"><?php echo "Add Skill"; //echo $this->lang->line('sitesettings_button_savesettings') ?></button>
                        </div>
                    </div>
                    <div class="col-sm-12 title">
                        <div class="col-sm-4">
                            <label for="name" class="control-label"><b><?php echo "Language Name"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                        <div class="col-sm-4">
                            <label for="name" class="control-label"><b><?php echo "Ratings"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                        <div class="col-sm-4">
                            <label for="name" class="control-label"><b><?php echo "Action"; //echo $this->lang->line('modal_pagesettings_pagetitle') ?></b></label>
                        </div>
                    </div>
                    <div class="additionlangs">
<?PHP
if (isset($resumeData['lang']) && is_array($resumeData['lang']) && count($resumeData['lang']) > 0):
    foreach ($resumeData['lang'] as $r):
        ?>				
                                <div class="col-sm-12">
                                    <div class="col-sm-4"><?PHP echo $r->language; ?></div>
                                    <div class="col-sm-4"><?PHP echo $r->rating; ?></div>
                                    <div class="col-sm-4"><button type="button" id="<?PHP echo $r->id; ?>" class="btn btn-info btn-embossed deleteLang"><?php echo "X"; //echo $this->lang->line('modal_cancelclose')  ?></button></div>
                                </div>
        <?PHP
    endforeach;
endif;
?>					
                    </div>
                    <div class="col-sm-12">
                        <div class="modal-footer modal-footer-btn">
                            <button type="button" class="btn btn-default btn-embossed backlangs"><?php echo "Previous"; //echo $this->lang->line('modal_cancelclose')  ?></button>
                            <button type="button" class="btn btn-primary btn-embossed" id="endSettings"><?php echo "Finish"; //echo $this->lang->line('sitesettings_button_savesettings')  ?></button>
                        </div>	
                    </div>

                </div>
            </form>
        </div>

    </div>
</div><!-- /.optionPane -->
<script>
    $(document).ready(function() {
        /* Save Basic details */
        $("#pageResumeBasics").on("click", "#saveBasicDetails", function() {
            btn = $(this);
            btn.prop('disabled', true);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('sites/updateMyResume')?>',
                dataType: 'json',
                data: $('form#pageResumeBasics').serialize(),
                success: function(data) {
                    $(".notification_msg").html(data.responseALERT);
                    btn.prop('disabled', false);
                    $(".edu").click();
                }
            });
        });

        /* Save Education Details  */
        $("#pageResumeEducation").on("click", "#addEducation", function() {
            btn = $(this);
            btn.prop('disabled', true);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('sites/updateMyResume')?>',
                dataType: 'json',
                data: $('form#pageResumeEducation').serialize(),
                success: function(data) {
                    $(".notification_msg").html(data.responseALERT);
                    if (data.responseCode == 1) {
                        $(".myeducation").prepend(data.payload);
                    }
                    btn.prop('disabled', false);
                    $('#pageResumeEducation')[0].reset();
                }
            });
        });
        /* Save save Skills */
        $("#pageResumeSkills").on("click", "#saveSkills", function() {
            btn = $(this);
            btn.prop('disabled', true);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('sites/updateMyResume')?>',
                dataType: 'json',
                data: $('form#pageResumeSkills').serialize(),
                success: function(data) {
                    $(".notification_msg").html(data.responseALERT);
                    if (data.responseCode == 1) {
                        $(".additionalskills").prepend(data.payload);
                    }
                    btn.prop('disabled', false);
                    $('#pageResumeSkills')[0].reset();
                    //$(".language").click();

                }
            });
        });

        /* Save Languages  */
        $("#pageResumeLanguages").on("click", "#saveLanguages", function() {
            btn = $(this);
            btn.prop('disabled', true);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('sites/updateMyResume')?>',
                dataType: 'json',
                data: $('form#pageResumeLanguages').serialize(),
                success: function(data) {
                    $(".notification_msg").html(data.responseALERT);
                    if (data.responseCode == 1) {
                        $(".additionlangs").prepend(data.payload);
                    }
                    btn.prop('disabled', false);
                    $('#pageResumeLanguages')[0].reset();
                }
            });
        });

        /* delete the education details */
        $("#pageResumeEducation").on("click", ".deleteEducation", function() {
            btn = $(this);
            btn.prop('disabled', true);
            id = $(this).attr("id");
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('sites/deleteCVDetails')?>',
                dataType: 'json',
                data: {"delete": "education", "id": id},
                success: function(data) {
                    $(".notification_msg").html(data.responseALERT);
                    btn.parent().parent().remove();
                    btn.prop('disabled', false);
                    //$(".language").click();

                }
            });
        });

        /* delete the skills of stuent */
        $("#pageResumeSkills").on("click", ".deleteSkill", function() {
            btn = $(this);
            btn.prop('disabled', true);
            id = $(this).attr("id");
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('sites/deleteCVDetails')?>',
                dataType: 'json',
                data: {"delete": "skills", "id": id},
                success: function(data) {
                    $(".notification_msg").html(data.responseALERT);
                    btn.parent().parent().remove();
                    btn.prop('disabled', false);
                    //$(".language").click();

                }
            });
        });

        /* delete the languages for student */
        $("#pageResumeLanguages").on("click", ".deleteLang", function() {
            btn = $(this);
            btn.prop('disabled', true);
            id = $(this).attr("id");
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('sites/deleteCVDetails')?>',
                dataType: 'json',
                data: {"delete": "lang", "id": id},
                success: function(data) {
                    $(".notification_msg").html(data.responseALERT);
                    btn.parent().parent().remove();
                    btn.prop('disabled', false);
                    //$(".language").click();

                }
            });
        });

        /*		//validation rules
         $("#pageResumeBasics").validate({
         rules: {
         "r_title": {
         required: true
         },
         "r_title": {
         required: true
         },  				
         "example4-password": {
         required: true,
         minlength: 5
         } 
         },
         //perform an AJAX post to ajax.php
         submitHandler: function() {
         $.post('ajax.php', 
         $('form#example4').serialize() , 
         function(data){
         alert(data.msg);
         }, "json");
         }
         });
         */
        $(".langs").click(function() {
            $(".skill").click();
            $(".notification_msg").html("");
        });
        $(".backlangs").click(function() {
            $(".skill").click();
            $(".notification_msg").html("");
        });
        $(".backskill").click(function() {
            $(".edu").click();
            $(".notification_msg").html("");
        });
        $(".backeducation").click(function() {
            $(".basic").click();
            $(".notification_msg").html("");
        });
        $("#nextEducation").click(function() {
            $(".skill").click();
            $(".notification_msg").html("");
        });
        $("#nextSkills").click(function() {
            $(".language").click();
            $(".notification_msg").html("");
        });
        $("#endSettings").click(function() {
            $('#resumeSettingModal').modal('hide');
            $(".notification_msg").html("");
        });
    });
</script>