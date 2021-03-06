/*
 
 HTML Builder front-end version 1.5
 
 */


/* SETTINGS */

var pageContainer = ".wrap"; //typically no need to change this
var enablePreview = true; //set to off to disable previews
var forColor = ''; //Get Editor's content color
var editableItems = new Array();

editableItems['.frameCover'] = [];
editableItems['.item-list-right li, .item-list-left li, .item-list-center li'] = ['animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.item-list-border li'] = ['color', 'background-color', 'border-color', 'border-width', 'border-radius', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.step-left-block li, .step-center-block li, .step-path-block li'] = ['background-color', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.diagram .column span'] = ['height', 'color', 'background-color', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.diagram-horizontal .column span'] = ['width', 'color', 'background-color', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.color-mark'] = ['background-color'];
editableItems['.icon'] = ['color', 'font-size', 'opacity', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['nav'] = ['background-color', 'color', 'opacity'];
editableItems['nav a'] = ['color', 'font-size', 'background-color', 'font-family', 'text-transform'];
editableItems['nav li'] = ['background-color', 'border-color', 'border-width'];
editableItems['h1'] = ['color', 'font-size', 'background-color', 'font-family', 'margin-bottom', 'margin-top', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['h2'] = ['color', 'font-size', 'background-color', 'font-family', 'margin-bottom', 'margin-top', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['h3'] = ['color', 'font-size', 'background-color', 'font-family', 'margin-bottom', 'margin-top', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['h4'] = ['color', 'font-size', 'background-color', 'font-family', 'margin-bottom', 'margin-top', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['h5'] = ['color', 'font-size', 'background-color', 'font-family', 'margin-bottom', 'margin-top', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['p'] = ['color', 'font-size', 'background-color', 'font-family', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.name'] = ['color', 'font-size', 'background-color', 'font-family', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['a.btn, a.download-btn, button.btn, a.goto'] = ['color', 'border-color', 'border-width', 'border-style', 'border-radius', 'font-size', 'background-color', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['img'] = ['border-top-left-radius', 'border-top-right-radius', 'border-bottom-left-radius', 'border-bottom-right-radius', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['form'] = ['animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.portfolio-list img'] = ['border-top-left-radius', 'border-top-right-radius', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-color', 'border-style', 'border-width'];
editableItems['.footer a'] = ['color'];
editableItems['ul.diagram, ul.diagram-horizontal'] = ['background-image', 'background-color', 'background-repeat', 'background-size', 'background-attachment', 'border-color', 'border-width', 'border-radius'];
editableItems['header'] = ['background-image', 'background-color', 'background-repeat', 'background-size', 'background-attachment'];
editableItems['.editBg'] = ['background-image', 'background-color', 'background-repeat', 'background-size', 'background-attachment'];
editableItems['section'] = ['background-image', 'background-color', 'background-repeat', 'background-size', 'background-attachment', 'padding-top', 'padding-bottom', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['footer'] = ['background-image', 'background-color', 'background-repeat', 'background-size'];
editableItems['.types-block .row > div'] = ['background-image', 'background-color', 'background-repeat', 'background-size'];
editableItems['.pricing-table span'] = ['padding-top', 'padding-bottom', 'background-image', 'background-color', 'background-repeat', 'background-size'];
editableItems['.container-half'] = ['background-image', 'background-color', 'background-size', 'background-attachment', 'background-position'];
editableItems['#testimonials-grid .quote, .pricing-table, .pricing-table .stamp, .post, .panel, .panel-heading, .form-container, .post-content .price-circle'] = ['color', 'border-color', 'border-width', 'border-radius', 'font-size', 'background-color', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.carousel-control .arrow'] = ['border-radius', 'border-color', 'border-style', 'border-width'];
editableItems['.num-icon'] = ['color', 'background-color', 'border-radius', 'border-color', 'border-width', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.step-num'] = ['color', 'background-color', 'border-radius', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.countdown'] = ['color', 'background-color', 'border-radius', 'border-color', 'border-width', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.border-block'] = ['font-size', 'font-family', 'color', 'background-color', 'border-color', 'border-width', 'border-radius', 'animation', 'data-wow-duration', 'data-wow-delay'];
editableItems['.editContent'] = ['color', 'font-size', 'background-color', 'font-family', 'padding-right', 'padding-left'];
editableItems['#team-circle .col-sm-4'] = [];
editableItems['#team-full .col-sm-4'] = [];
editableItems['#price-3col .benefits-list'] = [];
editableItems['#diagram-full li'] = [];
editableItems['#diagram-horiz-full li'] = [];
editableItems['#border'] = [];
//editableItems['#intro-video-form .propClone'] = [];
//editableItems['.propClone'] = [];

var editableItemOptions = new Array();

editableItemOptions['nav a : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['nav a : text-transform'] = ['none', 'capitalize', 'uppercase', 'lowercase'];
editableItemOptions['a.btn : border-radius'] = ['0px', '4px', '10px'];
editableItemOptions['.portfolio-list img : border-style'] = ['none', 'dotted', 'dashed', 'solid'];
editableItemOptions['a.btn, a.download-btn, button.btn, a.goto : border-style'] = ['none', 'dotted', 'dashed', 'solid'];
editableItemOptions['img : border-style'] = ['none', 'dotted', 'dashed', 'solid'];
editableItemOptions['img : border-width'] = ['1px', '2px', '3px', '4px'];
editableItemOptions['h1 : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['h2 : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['h3 : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['h4 : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['h5 : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['p : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['.name : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['.editContent : font-family'] = ['default', 'Lato', 'Helvetica', 'Arial', 'Times New Roman'];
editableItemOptions['header : background-repeat'] = ['no-repeat', 'repeat', 'repeat-x', 'repeat-y'];
editableItemOptions['header : background-size'] = ['cover', 'auto'];
editableItemOptions['header : background-attachment'] = ['fixed', 'scroll'];
editableItemOptions['section : background-repeat'] = ['no-repeat', 'repeat', 'repeat-x', 'repeat-y'];
editableItemOptions['section : background-size'] = ['cover', 'auto'];
editableItemOptions['section : background-attachment'] = ['fixed', 'scroll'];
editableItemOptions['footer : background-repeat'] = ['no-repeat', 'repeat', 'repeat-x', 'repeat-y'];
editableItemOptions['footer : background-size'] = ['cover', 'auto'];
editableItemOptions['.pricing-table span : background-repeat'] = ['no-repeat', 'repeat', 'repeat-x', 'repeat-y'];
editableItemOptions['.pricing-table span : background-size'] = ['cover', 'auto'];
editableItemOptions['.container-half : background-size'] = ['cover', 'contain', 'auto'];
editableItemOptions['.container-half : background-attachment'] = ['fixed', 'scroll'];
editableItemOptions['.container-half : background-position'] = ['top', 'right', 'bottom', 'left', 'left top', 'right top', 'right bottom', 'left bottom'];
editableItemOptions['.editBg : background-repeat'] = ['no-repeat', 'repeat', 'repeat-x', 'repeat-y'];
editableItemOptions['.editBg : background-size'] = ['cover', 'auto'];
editableItemOptions['.editBg : background-attachment'] = ['fixed', 'scroll'];

var editableContent = ['.editContent', '.content', '.post-desc', '.post-info', '.slogan', '.panel-body', 'h1', 'h2', 'h3', 'h4:not(.price)', 'h5', '.tableWrapper', '.navbar a', 'button', 'a.btn', 'a.btn span', 'a.download-btn', 'a.download-btn span', 'a.goto ', 'a.goto span', '.footer a:not(.icon)', '.tableWrapper', '.item-list-right li', '.item-list-center li', '.item-list-border li', '.portfolio-list .name', '.portfolio-list .price', '.portfolio-list .label', '.pricing-table span', '.pricing-table .benefits-list', '.widget ul', 'ul.tags li', '.links-list', '.step-text', '.step-num', '.diagram .column span', '.diagram .name', '.diagram-horizontal .column span', '.diagram-horizontal .name', '.nav-tabs li a', '.nav-tabs-round li a', 'p:not(.price)', '.num-icon', '.soc-list .icon'];

var editContForAnim = ['section', '.icon', 'img', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'p', 'a.btn, a.download-btn, button.btn, a.goto', '.num-icon', '.step-num', '.countdown', '.item-list-right li, .item-list-left li, .item-list-center li', '#testimonials-grid .quote, .pricing-table, .pricing-table .stamp, .post, .panel, .panel-heading, .form-container, .post-content .price-circle', '.step-left-block li, .step-center-block li, .step-path-block li', '.diagram .column span', '.diagram-horizontal .column span', '.item-list-border li', '.border-block', '.name'];

for (var i = 0; i < editContForAnim.length; i++) {
    editableItemOptions[editContForAnim[i] + ' : animation'] = [
        'none',
        'bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'wobble', 'jello',
        'bounceIn', 'bounceInDown', 'bounceInLeft', 'bounceInRight', 'bounceInUp',
        'bounceOut', 'bounceOutDown', 'bounceOutLeft', 'bounceOutRight', 'bounceOutUp',
        'fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig',
        'fadeOut', 'fadeOutDown', 'fadeOutDownBig', 'fadeOutLeft', 'fadeOutLeftBig', 'fadeOutRight', 'fadeOutRightBig', 'fadeOutUp', 'fadeOutUpBig',
        'flip', 'flipInX', 'flipInY', 'flipOutX', 'flipOutY',
        'lightSpeedIn', 'lightSpeedOut',
        'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight',
        'rotateOut', 'rotateOutDownLeft', 'rotateOutDownRight', 'rotateOutUpLeft', 'rotateOutUpRight',
        'slideInUp', 'slideInDown', 'slideInLeft', 'slideInRight',
        'slideOutUp', 'slideOutDown', 'slideOutLeft', 'slideOutRight',
        'zoomIn', 'zoomInDown', 'zoomInLeft', 'zoomInRight', 'zoomInUp',
        'zoomOut', 'zoomOutDown', 'zoomOutLeft', 'zoomOutRight', 'zoomOutUp',
        'hinge', 'rollIn', 'rollOut'
    ];
}


/* FLAT UI PRO INITS */

$(function() {

    // Tabs
    $(".nav-tabs a").on('click', function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/* END SETTINGS */

var mainMenuWidth = 230;
var secondMenuWidth = 200;

//local storage check
if (typeof (Storage) !== "undefined") {

    localStorage = true;

} else {

    localStorage = false;

}

$(window).load(function() {

    $('#loader').fadeOut(function() {
        $('[class^="html5gallery-container"]').remove();
        $(".html5gallery").html5gallery();
    });


    //activate previews?
    if (enablePreview == true) {

        $('#preview').show();

    }

    //header tooltips
    if ($('#publishPage').attr('data-toggle') == 'tooltip') {

        $('#publishPage').tooltip('show');

        setTimeout(function() {
            $('#publishPage').tooltip('hide');
        }, 5000);

    }

    $('#modeElementsLabel').tooltip('hide');
    $('#modeContentLabel').tooltip('hide');
    $('#modeStyleLabel').tooltip('hide');


    //publish hash?
    if (window.location.hash == "#publish") {

        $('#publishPage').click();

    }

    if ($('#pageList ul:visible > li').size() == 0) {

        $('#start').show();

        $('#frameWrapper').addClass('empty');

    } else {

        $('#start').hide();

        $('#frameWrapper').removeClass('empty');

    }
});


var hexDigits = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f");

//Function to convert hex format to a rgb color
function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

function getRandomArbitrary(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}

var pendingChanges = false;

function setPendingChanges(v) {

    if (v == true) {

        $('#savePage .bLabel').text("Save changes (!)");
        $('#savePage').removeClass('btn-primary');
        $('#savePage').removeClass('disabled');
        $('#savePage').addClass('btn-success');

        $('.tempSavecls .bLabel').text("Save changes (!)");
        $('.tempSavecls').removeClass('btn-primary');
        $('.tempSavecls').removeClass('disabled');
        $('.tempSavecls').addClass('btn-success');
        pendingChanges = true;

    } else {

        $('#savePage .bLabel').text("Nothing to save");
        $('#savePage').removeClass('btn-success');
        $('#savePage').addClass('btn-primary');
        $('#savePage').addClass('disabled');

        $('.tempSavecls .bLabel').text("Nothing to save");
        $('.tempSavecls').removeClass('btn-success');
        $('.tempSavecls').addClass('btn-primary');
        $('.tempSavecls').addClass('disabled');

        pendingChanges = false;

    }

}

function pageEmpty() {

    if ($('#pageList ul:visible > li').size() == 0) {

        $('#start').show();

        $('#frameWrapper').addClass('empty');

    } else {

        $('#start').hide();

        $('#frameWrapper').removeClass('empty');

    }

}

var emptyMarker = true;

function allEmpty() {

    var allEmpty = false;

    if ($('#pageList li').size() == 0) {

        allEmpty = true;

    } else {

        allEmpty = false;

    }

    emptyMarker = allEmpty;

    if (allEmpty) {

        $('a.actionButtons:not(#siteSettingsButton, #savePage)').each(function() {

            $(this).addClass('disabled');

        });

        $('header .modes input').each(function() {

            $(this).prop('disabled', true).parent().addClass('disabled');

        });

    } else {

        $('header .modes input').each(function() {

            $(this).prop('disabled', false).parent().removeClass('disabled');

        });

        $('a.actionButtons').each(function() {

            $(this).removeClass('disabled');

        });

    }

}

function prepPagesforSave() {

    var thePages = {};

    //work through pages/sections
    $('#pageList > ul').each(function() {

        pageName = $('#pages li:eq(' + ($(this).index() + 1) + ') a:first').text();

        pageFrames = [];

        if ($(this).find('li > section').size() > 0) {//we've got frames

            $(this).find('li > section').each(function() {

                frame = {};

                frame['frameContent'] = $(this).html();

                //get real frame height rather then from the array

                /*frame['frameHeight'] = frames[$(this).attr('id')];*/

                //show the parent LI to render the markup inside the section

                $('#pageList > ul').hide();

                $(this).closest('ul').show();

                frame['frameHeight'] = this.offsetHeight;

                //update the array as well
                frames[$(this).attr('id')] = this.offsetHeight;

                frame['originalUrl'] = $(this).attr('data-originalurl');

                //thePages[pageName][c] = frameContent;

                pageFrames.push(frame);

            });

            thePages[pageName] = pageFrames;

        } else {//no frames

            thePages[pageName] = '';

        }

    });

    //show the active page

    $('#pages li.active').removeClass('active').find('a:first').click();

    return thePages;

}

function makeDraggable(theID) {

    $('#second #elements li').each(function() {

        $(this).draggable({
            helper: function() {
                return $('<div style="height: 100px; width: 300px; background: #fafafa; box-shadow: 1px 1px 1px rgba(0,0,0,0.15); text-align: center; line-height: 100px; font-size: 28px; color: #00baff"><span class="fui-list"></span></div>');
            },
            revert: 'invalid',
            appendTo: 'body',
            connectToSortable: theID,
            stop: function() {
                pageEmpty();
                allEmpty();
            },
            start: function() {
                //switch to block mode
                //$('input:radio[name=mode]#modeBlock').trigger("click");
                $(".modes label:first").click();
                $('input:radio[name=mode]').parent().addClass('disabled');

                //show all section covers and activate designMode

                $('#pageList ul .zoomer-wrapper .zoomer-cover').each(function() {
                    $(this).show();
                });

                //deactivate designmode

                $('#pageList ul li section').each(function() {
                    this.designMode = "off";
                });

            }
        });

    });

    $('#second #htmltemplates li').each(function() {

        $(this).draggable({
            helper: function() {
                return $('<div style="height: 100px; width: 300px; background: #fafafa; box-shadow: 1px 1px 1px rgba(0,0,0,0.15); text-align: center; line-height: 100px; font-size: 28px; color: #00baff"><span class="fui-list"></span></div>');
            },
            revert: 'invalid',
            appendTo: 'body',
            connectToSortable: theID,
            stop: function() {

                pageEmpty();
                allEmpty();

            },
            start: function() {
                //switch to block mode
                $('input:radio[name=mode]').parent().addClass('disabled');
                $(".modes label:first").click();
                //$('input:radio[name=mode]#modeBlock').trigger('click');

                //show all section covers and activate designMode

                $('#pageList ul .zoomer-wrapper .zoomer-cover').each(function() {
                    $(this).show();
                });

                //deactivate designmode

                $('#pageList ul li section').each(function() {
                    this.designMode = "off";
                });
            }
        });
    });

    $('#elements li a').each(function() {

        $(this).unbind('click').bind('click', function(e) {
            e.preventDefault();

        });

    });

}

var frameContents = '';//holds frame contents

function makeSortable(el) {
    el.sortable({
        revert: true,
        placeholder: "drop-hover",
        handle: ".frameCover",
        beforeStop: function(event, ui) {

            if (ui.item.find('.frameCover').size() == 0) {

                if (ui.item.hasClass("templates")) {

                    var Themes_Elements = _HtmlElements.elements.Templates[ui.item.attr("order")].sequence;
                    //console.log(ui.item);
                    ui.item.remove();
                    //console.log(ui.item);
                    $.ajax({
                        type: "POST",
                        data: {posts: JSON.stringify(Themes_Elements), url: baseUrl},
                        url: ui.item.find('img').attr('data-srcc'),
                        beforeSend: function() {
                            $('#start').hide();
                            $("#pageList").css('background-image', 'url(' + baseUrl + 'assets/sites/images/loading.gif)');
                            $("#pageList").css('background-position', 'center center');
                            $("#pageList").css('background-repeat', 'no-repeat');
                        },
                        success: function(data) {

                            $("#pageList").css('background-image', 'none');
                            var i = 0;

                            $(data).find(".wrap").each(function() {
                                // Clone the li div and append the section in order to create single template. 
                                var el = ui.item.clone();
                                theHeight = Themes_Elements[i].height;

                                templete = '<div class="wrap">' + $(this).closest(".wrap").html() + '</div>';

                                // add section to each contents. 
                                el.html('<section src="' + baseUrl + "" + Themes_Elements[i].url + '" scrolling="no" data-originalurl="' + baseUrl + "" + Themes_Elements[i].url + '" frameborder="0">' + templete + '</section>');
                                el.find('section').html(templete);
                                //console.log(el);
                                el.find('section:first').uniqueId();
                                el.find('section:first').css('height', "auto");
                                el.find('section:first').css('padding', '0px');
                                el.find('section:first').css('z-index', '0');
                                //remove the link if it excists
                                el.find('.zoomer-cover a').remove();
                                //add a delete button
                                delButton = $('<button type="button" class="btn btn-danger deleteBlock"><span class="fui-trash"></span> remove</button>');
                                resetButton = $('<button type="button" class="btn btn-warning resetBlock"><i class="fa fa-refresh"></i> reset</button>');
                                htmlButton = $('<button type="button" class="btn btn-inverse htmlBlock"><i class="fa fa-code"></i> source</button>');

                                frameCover = $('<div class="frameCover"></div>');
                                frameCover.append(delButton);
                                frameCover.append(resetButton);
                                frameCover.append(htmlButton);

                                el.append(frameCover);
                                //console.log(el);
                                //dropped element, so we've got pending changes

                                el.find('.videoGallery').html5gallery();
                                $('#pageList > ul:visible').append(el);

                                heightAdjustment(el.find('section').attr('id'), true);

                                i++;
                            });

                        }
                    }).done(function() {
                        setPendingChanges(true);
                        $('#pageList > ul:visible li').each(function() {
                            $(this).find('.zoomer-cover > a').remove();
                        });
                        pageEmpty();
                        allEmpty();

                        $(".modes label:first").click();
                    });

                } else {//image thumbnails

                    theHeight = ui.item.find('img').attr('data-height');

                    ui.item.html('<section src="' + ui.item.find('img').attr('data-srcc') + '" scrolling="no"  data-originalurl="' + ui.item.find('img').attr('data-srcc') + '" frameborder="0"></section>');
                    $.ajax({
                        type: "POST",
                        url: ui.item.find('section:first').attr('data-originalurl'),
                        beforeSend: function() {
                            ui.item.find('section:first').css('background', '#ffffff url(' + baseUrl + 'assets/sites/images/loading.gif) 50% 50% ui.i no-repeat');
                        },
                        success: function(data) {
                            ui.item.find('section:first').css('background-image', 'none');
                            ui.item.find('section:first').html(data);

                            ui.item.find('section').find('[class^="html5gallery-container"]').remove();
                            ui.item.find('section').find('.html5gallery').html5gallery();
                        }
                    });
                    ui.item.find('section:first').uniqueId();
                    ui.item.find('section:first').css('height', theHeight + "px");
                    ui.item.find('section:first').css('padding', '0px');
                    ui.item.find('section:first').css('z-index', '0');

                    heightAdjustment(ui.item.find('section').attr('id'), true);

                    //add a delete button
                    delButton = $('<button type="button" class="btn btn-danger deleteBlock"><span class="fui-trash"></span> remove</button>');
                    resetButton = $('<button type="button" class="btn btn-warning resetBlock"><i class="fa fa-refresh"></i> reset</button>');
                    htmlButton = $('<button type="button" class="btn btn-inverse htmlBlock"><i class="fa fa-code"></i> source</button>');

                    frameCover = $('<div class="frameCover"></div>');

                    frameCover.append(delButton);
                    frameCover.append(resetButton);
                    frameCover.append(htmlButton);

                    ui.item.append(frameCover);
                }


            } else {

                //sorted
                ui.item.find('section').load(function() {
                    $(this).find(pageContainer).html(frameContents);
                });
            }
            setPendingChanges(true);

        },
        stop: function() {
            $('#pageList ul:visible li').each(function() {
                $(this).find('.zoomer-cover > a').remove();

            });

        },
        start: function(event, ui) {
            if (ui.item.find('.frameCover').size() != 0) {
                frameContents = ui.item.find('section').find(pageContainer).html();
            }
        },
        over: function() {
            $('#start').hide();
        }
    });
    //$('input:radio[name=mode]#modeBlock').trigger('click');
    $(".modes label:first").click();
}

$('#second #elements').on('click', 'li', function() {
    ui = $(this);
    var el = ui.clone();
    theHeight = ui.find('img').attr('data-height');
    el.html('<section src="' + ui.find('img').attr('data-srcc') + '" scrolling="no" data-originalurl="' + ui.find('img').attr('data-srcc') + '" frameborder="0"></section>');

    $.ajax({
        type: "POST",
        url: el.find('section').attr('data-originalurl'),
        beforeSend: function() {
            el.find('section').css('background', '#ffffff url(' + baseUrl + 'assets/sites/images/loading.gif) 50% 50% ui.i no-repeat');
        },
        success: function(data) {
            el.find('section').css('background-image', 'none');
            el.find('section').html(data);
        }
    }).done(function() {
        el.find('section:first').uniqueId();
        el.find('section:first').css('height', theHeight + "px");
        el.find('section:first').css('padding', '0px');
        el.find('section:first').css('z-index', '0');

        //remove the link if it excists
        el.find('.zoomer-cover a').remove();

        //add a delete button
        delButton = $('<button type="button" class="btn btn-danger deleteBlock"><span class="fui-trash"></span> remove</button>');
        resetButton = $('<button type="button" class="btn btn-warning resetBlock"><i class="fa fa-refresh"></i> reset</button>');
        htmlButton = $('<button type="button" class="btn btn-inverse htmlBlock"><i class="fa fa-code"></i> source</button>');

        frameCover = $('<div class="frameCover"></div>');

        frameCover.append(delButton);
        frameCover.append(resetButton);
        frameCover.append(htmlButton);

        el.append(frameCover);

        //dropped element, so we've got pending changes
        setPendingChanges(true);
        $('#pageList > ul:visible').append(el);
        heightAdjustment(el.find('section').attr('id'), true);
        $('#pageList > ul:visible li').each(function() {
            $(this).find('.zoomer-cover > a').remove();
        });
        $('[class^="html5gallery-container"]').remove();
        $(".html5gallery").html5gallery();
        pageEmpty();
        allEmpty();
        $('#start').hide();

        $('input:radio[name=mode]#modeBlock').trigger('click');
    });

});

$('#second #htmltemplates').on('click', 'li', function() {
    ui = $(this);
    var Themes_Elements = _HtmlElements.elements.Templates[$(this).attr("order")].sequence;
    $.ajax({
        type: "POST",
        data: {posts: JSON.stringify(Themes_Elements), url: baseUrl},
        url: ui.find('img').attr('data-srcc'),
        beforeSend: function() {
            $('#start').hide();
            $("#pageList").css('background-image', 'url(' + baseUrl + 'assets/sites/images/loading.gif)');
            $("#pageList").css('background-position', 'center center');
            $("#pageList").css('background-repeat', 'no-repeat');
        },
        success: function(data) {
            $("#pageList").css('background-image', 'none');
            var i = 0;
            //console.log(data);
            $(data).find(".wrap").each(function() {
                var el = ui.clone();

                theHeight = Themes_Elements[i].height;

                templete = '<div class="wrap">' + $(this).html() + '</div>';
                // add section to each contents. 
                el.html('<section src="' + baseUrl + "" + Themes_Elements[i].url + '" scrolling="no" data-originalurl="' + baseUrl + "" + Themes_Elements[i].url + '" frameborder="0">' + templete + '</section>');

//                el.find('section').html(templete);
                // console.log(el);
                el.find('section:first').uniqueId();
                el.find('section:first').css('height', "auto");
                //  el.find('section:first').css('background', '#ffffff url(' + baseUrl + 'assets/sites/images/loading.gif) 50% 50% no-repeat');
                el.find('section:first').css('padding', '0px');
                el.find('section:first').css('z-index', '0');

                //remove the link if it excists
                el.find('.zoomer-cover a').remove();

                //add a delete button
                delButton = $('<button type="button" class="btn btn-danger deleteBlock"><span class="fui-trash"></span> remove</button>');
                resetButton = $('<button type="button" class="btn btn-warning resetBlock"><i class="fa fa-refresh"></i> reset</button>');
                htmlButton = $('<button type="button" class="btn btn-inverse htmlBlock"><i class="fa fa-code"></i> source</button>');

                frameCover = $('<div class="frameCover"></div>');

                frameCover.append(delButton);
                frameCover.append(resetButton);
                frameCover.append(htmlButton);

                el.append(frameCover);
                //console.log(el);
                //dropped element, so we've got pending changes

                el.find('.videoGallery').html5gallery();
                $('#pageList > ul:visible').append(el);
                heightAdjustment(el.find('section').attr('id'), true);

                i++;
            });

        }
    }).done(function() {
        setPendingChanges(true);
        $('#pageList > ul:visible li').each(function() {
            $(this).find('.zoomer-cover > a').remove();
        });
        pageEmpty();
        allEmpty();

        $(".modes label:first").click();
    });
});

function buildeStyleElements(el, theSelector) {

    var animDisabled = false;

    for (x = 0; x < editableItems[theSelector].length; x++) {

        //create style elements

        if (editableItems[theSelector][x] == 'animation') {
            for (i = 0; i < editableItemOptions[theSelector + " : animation"].length; i++) {

                if ($(el).hasClass(editableItemOptions[theSelector + " : animation"][i])) {
                    var CssElement = editableItemOptions[theSelector + " : animation"][i];
                }

            }
        } else {
            if (editableItems[theSelector][x] == "border-width") {
                CssElement = $(el).css('border-top-width');
            }
            else if (editableItems[theSelector][x] == "border-color") {
                CssElement = $(el).css('border-top-color');
            }
            else if (editableItems[theSelector][x] == "border-style") {
                CssElement = $(el).css('border-top-Style');
            }
            else if (editableItems[theSelector][x] == "border-radius") {
                CssElement = $(el).css('border-top-right-radius');
            }
            else {
                var CssElement = $(el).css(editableItems[theSelector][x]) ||
                        $(el).attr(editableItems[theSelector][x]) || '1s';
            }
        }
        newStyleEl = $('#styleElTemplate').clone();

        newStyleEl.attr('id', '');
        newStyleEl.find('.control-label').text(editableItems[theSelector][x] + ":");

        if (theSelector + " : " + editableItems[theSelector][x] in editableItemOptions) {//we've got a dropdown instead of open text input

            //alert( theSelector+" "+editableItems[kkey][x] )

            newStyleEl.find('input').remove();


            var html = [
                '<div class="btn-group select">',
                '<button class="btn dropdown-toggle clearfix btn-sm btn-default" data-toggle="dropdown">',
                '<span class="filter-option pull-left" data-name=' + editableItems[theSelector][x] + '>Default</span>&nbsp;<span class="caret"></span>',
                '</button>',
                '<span class="dropdown-arrow dropdown-arrow-inverse"></span>',
                '<ul class="dropdown-menu dropdown-inverse" role="menu" style="overflow-y: auto; min-height: 0;">'
            ].join(''),
                    defaultTrigger = true;


            for (z = 0; z < editableItemOptions[ theSelector + " : " + editableItems[theSelector][x] ].length; z++) {

                if (editableItemOptions[theSelector + " : " + editableItems[theSelector][x]][z] == CssElement) {

                    //current value, marked as selected
                    html += '<li rel="' + z + '" class="btn-primary"><a href="#"><span class="pull-left">' + editableItemOptions[theSelector + ' : ' + editableItems[theSelector][x]][z] + '</span></a></li>';
                    defaultTrigger = false;

                } else {
                    html += '<li rel="' + z + '"><a href="#"><span class="pull-left">' + editableItemOptions[theSelector + ' : ' + editableItems[theSelector][x]][z] + '</span></a></li>';
                }
            }

            html += '</ul></div>';

            newDropDown = $(html);

            if (defaultTrigger) {
                newDropDown.find("ul li").eq(0).addClass("btn-primary");
                if (editableItems[theSelector][x] == "animation") {
                    animDisabled = true;
                }
            }
            var nameStyleDef = newDropDown.find('.btn-primary span').html();
            newDropDown.find('.filter-option').html(nameStyleDef);

            newStyleEl.append(newDropDown);
            newStyleEl.on('click', 'ul li', function(e) {
                e.preventDefault();
                var nameStyle = $(this).find('span').html(),
                        formGroup = $(this).parent().parent().parent();
                $(this).parent().find(".btn-primary").removeClass("btn-primary");
                $(this).addClass("btn-primary");
                formGroup.find('.filter-option').html(nameStyle);
                if (nameStyle == "none" && formGroup.find(".control-label").html() == "animation:") {
                    formGroup.nextAll().find('[name=data-wow-duration], [name=data-wow-delay]').each(function() {
                        $(this).attr('disabled', true);
                    });
                } else if (nameStyle != "none" && formGroup.find(".control-label").html() == "animation:") {
                    formGroup.nextAll().find('[name=data-wow-duration], [name=data-wow-delay]').each(function() {
                        $(this).attr('disabled', false);
                    });
                }
            });


        } else {
            newStyleEl.find('input').val(CssElement).attr('name', editableItems[theSelector][x]);

            if (editableItems[theSelector][x] == 'background-image') {

                newStyleEl.find('input').bind('focus', function() {

                    theInput = $(this);

                    $('#imageModal').modal('show');

                    $('#imageModal .image button.useImage').unbind('click');

                    $('#imageModal').on('click', '.image button.useImage', function() {

                        $(el).css('background-image', 'url("' + $(this).attr('data-url') + '")');

                        //update live image
                        theInput.val('url("' + $(this).attr('data-url') + '")');
                        //$(el).attr('src', $(this).attr('data-url'))

                        //update image URL field
                        //$('input#imageURL').val( $(this).attr('data-url') );

                        //hide modal
                        $('#imageModal').modal('hide');

                        //we've got pending changes
                        setPendingChanges(true);

                    });

                });

            } else if (editableItems[theSelector][x].indexOf("color") > -1) {

                //alert( editableItems[theSelector][x]+" : "+$(el).css( editableItems[theSelector][x] ) )

                if (CssElement != 'transparent' && CssElement != 'none' && CssElement != '') {

                    newStyleEl.val($(el).css(editableItems[theSelector][x]))

                }

                newStyleEl.find('input').spectrum({
                    preferredFormat: "hex",
                    showPalette: true,
                    allowEmpty: true,
                    showInput: true,
                    palette: [
                        ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
                        ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
                        ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                        ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                        ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                        ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
                        ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
                        ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
                    ]
                });

            } else if (editableItems[theSelector][x] == 'width') {

                var width = Math.round(100 * parseFloat($(el).css('width')) / parseFloat($(el).parent().css('width'))) + '%';
                newStyleEl.find('input').val(width).attr('name', editableItems[theSelector][x]);

            } else if (editableItems[theSelector][x] == 'height') {

                var height = Math.round(100 * parseFloat($(el).css('height')) / parseFloat($(el).parent().css('height'))) + '%';
                newStyleEl.find('input').val(height).attr('name', editableItems[theSelector][x]);

            }

        }

        newStyleEl.css('display', 'block');


        $('#styleElements').append(newStyleEl);


        $('#styleEditor form#stylingForm').height('auto');

        if (animDisabled) {
            newStyleEl.find("input").attr('disabled', true);
        }
    }

}

function getParentFrameID(el) {

    theID = '';

    $('#pageList li:visible section').each(function() {

        theBody = $(this).find('div.wrap');

        if ($.contains(document.getElementById($(this).attr('id')), el)) {

            theID = $(this).attr('id');

        }

    });

    if (theID != '') {

        return theID;

    }

}


function heightAdjustment(el, par) {

    par = typeof par !== 'undefined' ? par : false;

    if (par == false) {

        $('#pageList li:visible section').each(function() {

            theBody = $(this).find('div.wrap');

            if ($.contains(document.getElementById($(this).attr('id')), el)) {

                frameID = $(this).attr('id');

            }

        });

        theFrame = document.getElementById(frameID);

    } else {
        theFrame = document.getElementById(el);
    }

    //realHeight = theFrame.contentWindow.document.body.offsetHeight;

    //realHeight = theFrame.offsetHeight;
//alert(realHeight);
    //alert(theFrame.contentWindow.document.body.offsetHeight)

    $(theFrame).height("auto");

//    $(theFrame).parent().height((realHeight) + "px");
    $(theFrame).parent().height("auto");
//    $(theFrame).next().height((realHeight) + "px");
    $(theFrame).next().height("100%");
    //$(theFrame).parent().parent().height( (realHeight)+"px" );

}


var _oldIcon = new Array();


function styleClick(el) {
    //var timeStart = Date.now();
    theSelector = $(el).attr('data-selector');

    $('#editingElement').text(theSelector);

    //activate first tab
    $('#detailTabs a:first').click();

    //hide all by default
    $('a#link_Link').parent().hide();
    $('a#img_Link').parent().hide();
    $('a#icon_Link').parent().hide();
    $('a#video_Link').parent().hide();
    $('a#map_Link').parent().hide();

    //is the element an ancor tag?
    if ($(el).prop('tagName') == 'A' || $(el).parent().prop('tagName') == 'A') {

        $('a#link_Link').parent().show();

        if ($(el).prop('tagName') == 'A') {

            theHref = $(el).attr('href');

        } else if ($(el).parent().prop('tagName') == 'A') {

            theHref = $(el).parent().attr('href');

        }

        zIndex = 0;

        pageLink = false;

        //the actual select

        $('select#internalLinksDropdown').prop('selectedIndex', 0);

        $('select#internalLinksDropdown option').each(function() {

            if ($(this).attr('value') == theHref) {

                $(this).attr('selected', true);

                zIndex = $(this).index();

                pageLink = true;

            }

        });


        //the pretty dropdown
        $('.link_Tab .btn-group.select .dropdown-menu li').removeClass('selected');

        $('.link_Tab .btn-group.select .dropdown-menu li:eq(' + zIndex + ')').addClass('selected');

        $('.link_Tab .btn-group.select:eq(0) .filter-option').text($('select#internalLinksDropdown option:selected').text());

        $('.link_Tab .btn-group.select:eq(1) .filter-option').text($('select#pageLinksDropdown option:selected').text());

        if (pageLink == true) {

            $('input#internalLinksCustom').val('');

        } else {

            if ($(el).prop('tagName') == 'A') {

                if ($(el).attr('href')[0] != '#') {
                    $('input#internalLinksCustom').val($(el).attr('href'))
                } else {
                    $('input#internalLinksCustom').val('');
                }

            } else if ($(el).parent().prop('tagName') == 'A') {

                if ($(el).parent().attr('href')[0] != '#') {
                    $('input#internalLinksCustom').val($(el).parent().attr('href'))
                } else {
                    $('input#internalLinksCustom').val('');
                }

            }
        }

        //list available blocks on this page, remove old ones first

        $('select#pageLinksDropdown option:not(:first)').remove();

        $('#pageList ul:visible section').each(function() {

            if ($(this).find(pageContainer + " > *:first").attr('id') != undefined) {

                if ($(el).attr('href') == '#' + $(this).find(pageContainer + " > *:first").attr('id')) {

                    newOption = '<option selected value=#' + $(this).find(pageContainer + " > *:first").attr('id') + '>#' + $(this).find(pageContainer + " > *:first").attr('id') + '</option>';

                } else {

                    newOption = '<option value=#' + $(this).find(pageContainer + " > *:first").attr('id') + '>#' + $(this).find(pageContainer + " > *:first").attr('id') + '</option>';

                }

                $('select#pageLinksDropdown').append(newOption);

            }

        });

    }

    if ($(el).attr('data-type') == 'video') {

        $('a#video_Link').parent().show();

        $('a#video_Link').click();

        //inject current video ID,check if we're dealing with Youtube or Vimeo
        $('input#videoURL').val($(el).prev().attr('data-src'));
        if ($(el).prev().attr('data-src').indexOf("vimeo.com") > -1) {//vimeo

            match = $(el).prev().attr('data-src').match(/player\.vimeo\.com\/video\/([0-9]*)/);

            //console.log(match);

            $('#video_Tab input#vimeoID').val(match[match.length - 1]);
            $('#video_Tab input#youtubeID').val('');

        } else if ($(el).prev().attr('data-src').indexOf("youtube.com") > -1) {//youtube

            var regExp = /.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/;
            var match = $(el).prev().attr('data-src').match(regExp);

            $('#video_Tab input#youtubeID').val(match[1]);
            $('#video_Tab input#vimeoID').val('');

        }

        //alert( $(el).prev().attr('src') )

    }

    if ($(el).attr('data-type') == 'map') {

        $('a#map_Link').parent().show();

        $('a#map_Link').click();

        $('#map_Tab input#address').val();
    }

    if ($(el).prop('tagName') == 'IMG') {

        $('a#img_Link').parent().show();

        //set the current SRC
        $('.imageFileTab').find('input#imageURL').val($(el).attr('src'));

        //reset the file upload
        $('#uploadTab').find('a.fileinput-exists').click();

    }

    if ($(el).hasClass('icon')) {

        $('a#icon_Link').parent().show();

        //get icon class name, starting with fa-
        var get = $.grep(el.className.split(" "), function(v, i) {

            return v.indexOf('icon-') === 0;

        }).join();

        $('select#icons option').each(function() {

            if ($(this).val() == get) {

                $(this).attr('selected', true);

                $('#icons').trigger('chosen:updated');

            }

        });

    }

    if ($(el).closest('div.wrap').width() != $(el).width()) {
        $(el).css({'outline': '3px dotted red', 'cursor': 'pointer'});
    } else {
        $(el).css({'outline': '3px dotted red', 'outline-offset': '-3px', 'cursor': 'pointer'});
    }

    //remove all style attributes
    $('#styleElements > *:not(#styleElTemplate)').each(function() {
        $(this).remove();
    });

    //load the attributes
    buildeStyleElements(el, theSelector);

    //show style editor if hidden
    if ($('.styleEditor').css('left') == '-300px') {
        $('.styleEditor').animate({'left': '0px'}, 250);
    }

    //image library
    $('#imageModal').on('show.bs.modal', function(e) {

        $('#imageModal').off('click', '.image button.useImage');
        $('#imageModal').off('click', '.image button.deleteImage');

        $('#imageModal').on('click', '.image button.useImage', function() {

            //update live image
            var img_url = $(this).attr('data-url');
            if ($(el).is('[class^="html5gallery-elem-image"]')) {
                $(el).parents('div.imageGallery').find("a > img").each(function() {
                    if ($(this).attr('src') == $(el).attr('src')) {
                        $(this).attr('src', img_url);
                        $(this).parent('a').attr('href', img_url);
                    }
                });
                $('[class^="html5gallery-container"]').remove();
                $(".html5gallery").html5gallery();
                $(".modes label:nth-of-type(2)").click();
            } else {
                $(el).attr('src', img_url);
                $(el).parents("a").attr('href', img_url);
            }
            //update image URL field
            $('input#imageURL').val(img_url);

            //hide modal
            $('#imageModal').modal('hide');

            //we've got pending changes
            setPendingChanges(true);

            $(this).unbind('click');

        });

        $('#imageModal').on('click', '.image button.deleteImage', function() {
            var url = $(this).attr('data-url');
            var bucket = $(this).attr('data-bucket');

            var uri = $(this).attr('data-image');

            var confirm = window.confirm("Are you sure wants to delete this image?\nPress OK to delete or Cancel!");
            if (confirm) {
                $.ajax({
                    url: url,
                    data: {"bucket": bucket, "uri": uri},
                    dataType: "json",
                    type: 'POST'
                }).done(function(ret) {

                    //hide loader
                    $('#imageModal .loader').fadeOut(500);

                    if (ret.responseCode == 0) {//error

                        $('#imageModal .modal-alerts').append($(ret.responseHTML));

                    } else if (ret.responseCode == 1) {//success

                        //append my images
                        $('#myImagesTab > *').remove();
                        $('#myImagesTab').append($(ret.myImages));

                        $('#imageModal .modal-alerts').append($(ret.responseHTML));

                        setTimeout(function() {
                            $('#imageModal .modal-alerts > *').fadeOut(500);
                        }, 3000);
                    }
                });
            }
        });

    });

    //video library
    $('#videoModal').on('show.bs.modal', function(e) {

        $('#videoModal').off('click', '.video button.useVideo');
        $('#videoModal').off('click', '.video button.deleteVideo');

        $('#videoModal').on('click', '.video button.useVideo', function() {

            //update live video
            $(el).prev(".videoGallery").remove();

            $('<div class="videoGallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="' + $(this).attr('data-url') + '" data-showtitle="false" style="display:none;"></div>').insertBefore($(el));
            $('input#videoURL').val($(this).attr('data-url'));
            $('input#youtubeID').val('');
            $('input#vimeoID').val('');
            //hide modal
            $('#videoModal').modal('hide');

            //we've got pending changes
            setPendingChanges(true);

            $(this).unbind('click');
            $(".videoGallery").html5gallery();
        });

        $('#videoModal').on('click', '.video button.deleteVideo', function() {
            var url = $(this).attr('data-url');
            var bucket = $(this).attr('data-bucket');

            var uri = $(this).attr('data-video');

            var confirm = window.confirm("Are you sure wants to delete this video?\nPress OK to delete or Cancel!");
            if (confirm) {
                $.ajax({
                    url: url,
                    data: {"bucket": bucket, "uri": uri},
                    dataType: "json",
                    type: 'POST'
                }).done(function(ret) {

                    //hide loader
                    $('#videoModal .loader').fadeOut(500);

                    if (ret.responseCode == 0) {//error

                        $('#videoModal .modal-alerts').append($(ret.responseHTML));

                    } else if (ret.responseCode == 1) {//success

                        //append my images
                        $('#myVideosTab > *').remove();
                        $('#myVideosTab').append($(ret.myVideos));

                        $(".videoGallery").html5gallery();

                        $('#videoModal .modal-alerts').append($(ret.responseHTML));

                        setTimeout(function() {
                            $('#videoModal .modal-alerts > *').fadeOut(500);
                        }, 3000);
                    }
                });
            }
        });

    });

    //save button
    $('button#saveStyling').unbind('click').bind('click', function() {
        $('#styleEditor #tab1 .form-group:not(#styleElTemplate) input').each(function() {
            //alert( $(this).attr('name')+":"+$(this).val() )
            var nameAttrEl = $(this).attr('name'),
                    valAttr = $(this).val(),
                    disabled = $(this).attr('disabled');
            if (disabled != 'disabled') {
                if (nameAttrEl == 'data-wow-duration' || nameAttrEl == 'data-wow-delay') {
                    $(el).attr(nameAttrEl, valAttr);
                } else if (nameAttrEl == 'height') {
                    var valAttr = parseInt(valAttr);
                    $(el).css(nameAttrEl, valAttr + '%');
                    $(el).text(valAttr + '%');
                } else if (nameAttrEl == 'width') {
                    var valAttr = parseInt(valAttr);
                    $(el).css(nameAttrEl, valAttr + '%');
                    $(el).text(valAttr + '%');
                } else if ((nameAttrEl == 'background-color') && (valAttr == '')) {
                    valAttr = 'transparent';
                    $(el).css(nameAttrEl, valAttr);
                } else {
                    $(el).css(nameAttrEl, valAttr);
                }
            }

        });

        $('#styleEditor #tab1 .form-group:not(#styleElTemplate) .select .filter-option').each(function() {
            var nameAttrEl = $(this).attr('data-name'),
                    valAttr = $(this).html();
            if (nameAttrEl == 'animation') {
                if ($(el).hasClass('wow')) {
                    var regexp = /(\s)?wow\s*.*/,
                            clearClass = $(el).attr('class').replace(regexp, '');
                    $(el).attr('class', clearClass);
                }
                if (valAttr != 'none') {
                    $(el).addClass('wow ' + valAttr);
                } else {
                    $(el).removeAttr("data-wow-duration");
                    $(el).removeAttr("data-wow-delay");
                }

            } else {
                $(el).css(nameAttrEl, valAttr);
            }
        });

        //links
        if ($(el).prop('tagName') == 'A') {

            //change the href prop?
            if ($('select#internalLinksDropdown').val() != '#') {
                $(el).attr('href', $('select#internalLinksDropdown').val());
            } else if ($('select#pageLinksDropdown').val() != '#') {
                $(el).attr('href', $('select#pageLinksDropdown').val());
            } else if ($('input#internalLinksCustom').val() != '') {
                $(el).attr('href', $('input#internalLinksCustom').val());
            }

        }

        if ($(el).parent().prop('tagName') == 'A') {

            //change the href prop?

            if ($('select#internalLinksDropdown').val() != '#') {

                $(el).parent().attr('href', $('select#internalLinksDropdown').val());

            } else if ($('select#pageLinksDropdown').val() != '#') {

                $(el).parent().attr('href', $('select#pageLinksDropdown').val());

            } else if ($('input#internalLinksCustom').val() != '') {

                $(el).parent().attr('href', $('input#internalLinksCustom').val());

            }

        }

        //do we need to upload an image?
        if ($('a#img_Link').css('display') == 'block') {
            //no image to upload, just a SRC change
            if ($('input#imageURL').val() != '' && $('input#imageURL').val() != $(el).attr('src')) {

                if ($(el).is('[class^="html5gallery-elem-image"]')) {
                    $(el).parents('div.imageGallery').find("a > img").each(function() {
                        if ($(this).attr('src') == $(el).attr('src')) {
                            $(this).attr('src', $('input#imageURL').val());
                            $(this).parent('a').attr('href', $('input#imageURL').val());
                        }
                    });
                    $('[class^="html5gallery-container"]').remove();
                    $(".html5gallery").html5gallery();
                    $(".modes label:nth-of-type(2)").click();
                } else {
                    $(el).attr('src', $('input#imageURL').val());
                    $(el).load();
                }
            }
        }

        //icons

        if ($(el).hasClass('icon')) {

            //out with the old, in with the new :)
            //get icon class name, starting with fa-
            var get = $.grep(el.className.split(" "), function(v, i) {

                return v.indexOf('icon-') === 0;

            }).join();

            //if the icons is being changed, save the old one so we can reset it if needed

            if (get != $('select#icons').val()) {

                $(el).uniqueId();

                _oldIcon[$(el).attr('id')] = get;

                //alert( _oldIcon[$(el).attr('id')] )

            }

            $(el).removeClass(get).addClass($('select#icons').val());

        }


        //video URL

        if ($(el).attr('data-type') == 'video') {

            if ($('input#youtubeID').val() != '') {
                $(el).prev(".videoGallery").remove();
                $('<div class="videoGallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="https://www.youtube.com/embed/' + $('#video_Tab input#youtubeID').val() + '" data-showtitle="false" style="display:none;"></div>').insertBefore($(el));
            } else if ($('input#vimeoID').val() != '') {
                $(el).prev(".videoGallery").remove();
                $('<div class="videoGallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="https://player.vimeo.com/video/' + $('#video_Tab input#vimeoID').val() + '?title=0&amp;byline=0&amp;portrait=0" data-showtitle="false" style="display:none;"></div>').insertBefore($(el));
            } else {
                $(el).prev(".videoGallery").remove();
                $('<div class="videoGallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="' + $('#video_Tab input#videoURL').val() + '" data-showtitle="false" style="display:none;"></div>').insertBefore($(el));
            }
            $('#videoURL').val($(el).prev(".videoGallery").attr('data-src'));
            $(el).prev(".videoGallery").html5gallery();
        }

        //Map Address
        if ($(el).attr('data-type') == 'map') {

            if ($('input#address').val() != '') {
                var q = encodeURIComponent($('input#address').val());
                $(el).prev().attr('src', "https://www.google.com/maps/embed/v1/place?zoom=15&key=AIzaSyDJHRiNcO4Yf5NinGfaX0YkapWr0TuzThA&q=" + q);

            }

        }


        $('#detailsAppliedMessage').fadeIn(600, function() {

            setTimeout(function() {
                $('#detailsAppliedMessage').fadeOut(1000)
            }, 3000);

        });

        setPendingChanges(true);

    });

    //delete button
    $('button#removeElementButton').unbind('click').bind('click', function() {
//console.log($(el).parents().hasClass('propClone'));
        if ($(el).parents().hasClass('propClone')) {//clone the A

            toDel = $(el).parents('.propClone:first');

        } else if ($(el).prop('tagName') == 'A') {//ancor

            if ($(el).parent().prop('tagName') == 'LI') {//clone the LI

                toDel = $(el).parent();

            } else {

                toDel = $(el);

            }

        } else if ($(el).prop('tagName') == 'IMG') {//image

            if ($(el).parent().prop('tagName') == 'A') {//clone the A

                toDel = $(el).parent();

            } else {

                toDel = $(el);

            }

        } else {//everything else

            toDel = $(el);

        }

        $('#styleEditor').on('click', 'button#removeElementButton', function() {

            $('#deleteElement').modal('show');

            $('#deleteElement button#deleteElementConfirm').unbind('click').bind('click', function() {

                toDel.fadeOut(500, function() {

                    randomEl = $(this).closest('div.wrap').find('*:first');

                    toDel.remove();

                    heightAdjustment(randomEl[0]);

                });

                $('#deleteElement').modal('hide');

                closeStyleEditor();

            });

        });

        if ($(el).attr('data-selector') == '.diagram .column span') {
            //get parent div n calculate no of child. accordingly assign width
            var par = $(el).parents('li:first');
            var total_span = par.children("span.column").length;
            par.find("span.column").each(function() {
                var per_width = 100 / total_span;
                $(this).css("width", (per_width - 3) + "%");
                $(this).css("margin", "0 1%");
            });
        }
        if ($(el).attr('data-selector') == '#diagram-full li') {
            //get parent div n calculate no of child. accordingly assign width
            var par = $(el).parents('ul.diagram');
            var total_span = par.children("li").length;
            par.find("li").each(function() {
                var per_width = 100 / total_span;
                $(this).css("width", (per_width - 3) + "%");
            });
        }

    });

    //clone button
    $('button#cloneElementButton').unbind('click').bind('click', function() {
        //console.log(($(el).parents.hasClass('.propClone'));
        if (($(el).prop('tagName') == 'IMG') && ($(el).parents().hasClass('.propClone'))) {



            if ($(el).hasClass('ui-resizable')) {
                $(el).resizable('destroy');
            }

            theClone = $(el).parents('.propClone:first').clone();
            theClone.find($(el).prop('tagName')).attr('style', '');

            cloned = $(el).parent();

        } else if ($(el).parents().hasClass('propClone')) {//clone the parent element

            $(el).parent().find('img').each(function() {
                if ($(this).hasClass('ui-resizable')) {
                    $(this).resizable('destroy');
                }
            });

            theClone = $(el).parents('.propClone:first').clone();
            //theClone.find($(el).prop('tagName')).attr('style', '');

            theOne = theClone.find($(el).prop('tagName'));
            cloned = $(el).parents('.propClone:first');

            cloneParent = $(el).parent().parent();

        } else if ($(el).prop('tagName') == 'IMG') {

            if ($(el).hasClass('ui-resizable')) {
                $(el).resizable('destroy');
            }
            theClone = $(el).clone();
            theClone.find($(el).prop('tagName')).attr('style', '');

            cloned = $(el).parent();
        } else {//clone the element itself
            $(el).find('img').each(function() {
                if ($(this).hasClass('ui-resizable')) {
                    $(this).resizable('destroy');
                }
            });
            theClone = $(el).clone();
            theClone.attr('style', '');
            theClone.css({'position': 'relative'});

            theOne = theClone;
            cloned = $(el);

            cloneParent = $(el).parent();

        }
        if (theClone.hasClass('ui-draggable ui-draggable-handle')) {
            theClone.removeClass('ui-draggable ui-draggable-handle');
        }
        if (theClone.hasClass('drag')) {
            theClone.draggable({cancel: false, start: function(event, ui) {
                    setPendingChanges(true);
                }});
        }
        theClone.find('.drag').each(function() {

            if ($(this).hasClass('ui-draggable ui-draggable-handle')) {
                $(this).removeClass('ui-draggable ui-draggable-handle');
            }
            $(this).draggable({cancel: false, start: function(event, ui) {
                    setPendingChanges(true);
                }});
        });

//        theClone.find('img').each(function(){
//            $(this).resizable({alsoResize: $(this).parent()});
//        });

        cloned.after(theClone);
        setPendingChanges(true);

        activeStyling();
        //possible height adjustments



        if ($(el).attr('data-selector') == '.diagram .column span') {
            //get parent div n calculate no of child. accordingly assign width
            var par = $(el).parents('li:first');
            var total_span = par.children("span.column").length;
            par.find("span.column").each(function() {
                var per_width = 100 / total_span;
                $(this).css("width", (per_width - 3) + "%");
                $(this).css("margin", "0 1%");
            });
        }
        if ($(el).attr('data-selector') == '#diagram-full li') {
            //get parent div n calculate no of child. accordingly assign width
            var par = $(el).parents('ul.diagram');
            var total_span = par.children("li").length;
            par.find("li").each(function() {
                var per_width = 100 / total_span;
                $(this).css("width", per_width + "%");
            });
        }
    });

    //reset button
    $('button#resetStyleButton').unbind('click').bind('click', function() {

        pos = 'relative';
        if ($(el).prop('tagName') == 'IMG') {

            if ($(el).hasClass('pf')) {
                $(el).parents('li.drag:first').attr('style', '');
            }
            $(el).parents('div.drag:first').attr('style', '');
            $(el).parents('div.drag:first').attr('style', 'display: inline-block;');

            if ($(el).parents().hasClass('navbar-brand')) {
                $(el).parents('span:first').attr('style', '');
            }
            $(el).parents('div.drag:first').css("position", pos);
            if ($(el).hasClass('ui-resizable')) {
                $(el).resizable('destroy');
            }
        }
        else if ($(el).hasClass('frameCover')) {

            if ($(el).hasClass('pf')) {
                $(el).parents('li.drag:first').attr('style', '');
            }
            pos = $(el).parents('div.drag:first').css("position");
            $(el).parents('div.drag:first').attr('style', '');
            $(el).parents('div.drag:first').css("position", pos);

            if ($(el).hasClass('ui-resizable')) {
                $(el).resizable('destroy');
            }
        }
        else if ($(el).hasClass('navbar-brand')) {
            $(el).find('span').attr('style', '');
            $(el).find('span').css('position', 'relative');
        }
        /*else if ($(el).attr('data-selector') == 'nav a') {
         $(el).parents('li.drag:first').attr('style', '');
         }*/
        else if (!($(el).hasClass('drag'))) {
            pos = $(el).css("position");
            $(el).parents('.drag:first').attr('style', '');
        }

        $(el).attr('style', '');
        $(el).css("position", pos);
        $(el).parents('.drag:first').css('position', 'relative');

        $('#styleEditor form#stylingForm').height($('#styleEditor form#stylingForm').height() + "px");

        $('#styleEditor form#stylingForm .form-group:not(#styleElTemplate)').fadeOut(500, function() {

            $(this).remove();

        });

        if ($(el).hasClass('frameCover')) {
            $(el).css("position", 'absolute');
        }

        //reset icon

        if (_oldIcon[$(el).attr('id')] != null) {

            var get = $.grep(el.className.split(" "), function(v, i) {

                return v.indexOf('icon-') === 0;

            }).join();

            $(el).removeClass(get).addClass(_oldIcon[$(el).attr('id')]);

            $('select#icons option').each(function() {

                if ($(this).val() == _oldIcon[$(el).attr('id')]) {

                    $(this).attr('selected', true);

                    $('#icons').trigger('chosen:updated');

                }

            });

        }

        //setTimeout( function(){buildeStyleElements(el, theSelector)}, 550)

    });

}


function closeStyleEditor() {

    //only if visible

    if ($('.styleEditor').css('left') == '0px') {

        $('.styleEditor').animate({'left': '-300px'}, 250);

        $('#pageList ul li section').each(function() {

            //remove hover events used by Styling modus

            for (var key in editableItems) {
                $(this).find(pageContainer + ' ' + key).css({'outline': '', 'cursor': ''});
                // TODO: it realy need? This code overloads the process
//                $(this).find(pageContainer + ' ' + key).unbind('mouseenter mouseleave click').css({'outline': '', 'cursor': ''});

            }

        });

    }

}

function activeStyling() {
    $('#pageList ul li section').each(function() {

        $(this).find('.frameCover').each(function() {
            $(this).show();
        });

        for (var key in editableItems) {

            //remove old click events
            $(this).find(key).unbind('click').unbind('hover');
//            
            $(this).find(key).hover(function(e) {

                e.stopPropagation();
                if ($(this).closest('div.wrap').width() != $(this).width()) {
                    $(this).css({'outline': '3px dotted red', 'cursor': 'pointer'});

                    if (($(this).prop('tagName') == 'IMG') && ($(this).hasClass('pf'))) {
                        if (!$(this).is(".ui-resizable")) {
                            $(this).resizable({alsoResize: $(this).parents("li.drag"), start: function(event, ui) {
                                    setPendingChanges(true);
                                }});
                        }
                    } else if (($(this).prop('tagName') == 'IMG') && ($(this).hasClass('pm'))) {
                        if (!$(this).is(".ui-resizable")) {
                            $(this).resizable({alsoResize: $(this).parents("div.pm"), start: function(event, ui) {
                                    setPendingChanges(true);
                                }});
                        }
                    } else if ($(this).prop('tagName') == 'IMG') {
                        if (!$(this).is(".ui-resizable")) {
                            $(this).resizable({
                                alsoResize: $(this).parent(),
                                start: function(event, ui) {
                                    setPendingChanges(true);
                                },
                                resize: function(event, ui) {
                                    $(this).css({'outline': '3px dotted red', 'cursor': 'pointer'});
                                },
                                stop: function(event, ui) {
                                    $(this).css({'outline': '', 'cursor': ''});
                                }
                            });
                        }

                    }// else {
                    if (!$(".drag").is(".ui-draggable")) {
                        $(".drag").draggable({cancel: false, start: function(event, ui) {
                                setPendingChanges(true);
                            }});
                    }
                } else {
                    $(this).css({'outline': '3px dotted red', 'outline-offset': '-3px', 'cursor': 'pointer'});
                }

            }, function() {
                $(this).css({'outline': '', 'cursor': '', 'outline-offset': ''})

            }).click(function(e) {

                e.preventDefault();

                e.stopPropagation();

                styleClick(this);

            }).each(function() {

                $(this).attr('data-selector', key);

            });

        }

    });
}

$(function() {

    //video ID toggle

    $('input#youtubeID').focus(function() {

        $('input#vimeoID').val('');

    });

    $('input#vimeoID').focus(function() {

        $('input#youtubeID').val('');

    });


    //chosen font-awesome dropdown

    $('select#icons').chosen({
        'search_contains': true
    });

    //detect mode
    if (window.location.protocol == 'file:') {

        _mode = "local";

    } else {

        _mode = "server";

    }

    //check if formData is supported
    if (!window.FormData) {

        //not supported, hide file upload
        $('form#imageUploadForm').hide();

        $('.imageFileTab #imageModal').hide();

        $('form#videoUploadForm').hide();

        $('.videoTab #videoModal').hide();

    }


    //internal links dropdown

    $('select#internalLinksDropdown').selectpicker({style: 'btn-sm btn-default', menuStyle: 'dropdown-inverse'});
    $('select#internalLinksDropdown').change(function() {

        $('select#pageLinksDropdown option').attr('selected', false);

        $('.link_Tab .btn-group.select:eq(1) .dropdown-menu li').removeClass('selected');

        $('.link_Tab .btn-group.select:eq(1) > button .filter-option').text($('.link_Tab .btn-group.select:eq(1) .dropdown-menu li:first').text());

    });

    $('select#pageLinksDropdown').selectpicker({style: 'btn-sm btn-default', menuStyle: 'dropdown-inverse'});

    $('select#pageLinksDropdown').change(function() {

        $('select#internalLinksDropdown option').attr('selected', false);

        $('.link_Tab .btn-group.select:eq(0) .dropdown-menu li').removeClass('selected');

        $('.link_Tab .btn-group.select:eq(0) > button .filter-option').text($('.link_Tab .btn-group.select:eq(0) .dropdown-menu li:first').text());

    });


    $('input#internalLinksCustom').focus(function() {

        $('select#internalLinksDropdown option').attr('selected', false);
        $('select#pageLinksDropdown option').attr('selected', false);

        $('.link_Tab .dropdown-menu li').removeClass('selected');

        $('.link_Tab .btn-group.select > button .filter-option').text($('.link_Tab .dropdown-menu li:first').text());

        this.select();

    });


    $('#detailsAppliedMessageHide').click(function() {

        $(this).parent().fadeOut(500);

    });


    //hide style editor option?

    if (typeof editableItems === 'undefined') {

        $('#modeStyle').parent().remove();

    }

    $('#closeStyling').click(function() {

        closeStyleEditor();

    });


    $('#styleEditor form').on("focus", "input", function() {

        $(this).css('position', 'absolute');
        $(this).css('right', '0px');

        $(this).animate({'width': '100%'}, 500);

        $(this).focus(function() {
            this.select();
        });

    }).on("blur", "input", function() {

        $(this).animate({'width': '42%'}, 500, function() {

            $(this).css('position', 'relative');
            $(this).css('right', 'auto');

        });

    });
    /* HTML BLOGS */
    for (var key in _HtmlElements.elements) {

        niceKey = key.toLowerCase().replace(" ", "_");

        if (niceKey == 'templates') {

            $('<li><a href="" id="' + niceKey + '"><span class="fa fa-newspaper-o"></span> ' + key + '</a></li>').appendTo('#menu #main ul#htmltemplates');

            for (x = 0; x < _HtmlElements.elements[key].length; x++) {

                // determines the order of the template
                order = ' order="' + x + '" ';

                if (_HtmlElements.elements[key][x].thumbnail == null) { //we'll need an section

                    //build us some sections!

                    newItem = $('<li ' + order + 'class="element ' + niceKey + '"><section src="about:blank" scrolling="no"></section></li>');

                    newItem.find('section').uniqueId();
                    newItem.find('section').attr('src', _HtmlElements.elements[key][x].url);

                } else { //we've got a thumbnail

                    newItem = $('<li ' + order + 'class="element ' + niceKey + '"><img  src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' + baseUrl + _HtmlElements.elements[key][x].thumbnail + '" data-srcc="' + baseUrl + _HtmlElements.elements[key][x].url + '"></li>')

                }

                newItem.appendTo('#menu #second ul#htmltemplates');

                // Zoomer works

                if (_HtmlElements.elements[key][x].height) {
                    theHeight = _HtmlElements.elements[key][x].height * 0.25;
                } else {
                    theHeight = 'auto';
                }

                newItem.find('section').zoomer({
                    zoom: 0.25,
                    width: 270,
                    height: theHeight,
                    message: "Drag&Drop Me!"
                });
            }

            // Draggables
            makeDraggable('#page1');
        }

    }
    /* Elements BLOGS */
    for (var key in _Elements.elements) {

        niceKey = key.toLowerCase().replace(" ", "_");

        if (niceKey == "ecommerce_tables" && display_ecom == 'yes') {
            $('<li><a href="" id="' + niceKey + '"><span class="fa fa-bars"></span> ' + key + '</a></li>').appendTo('#menu #main ul#elements');
        } else if (niceKey != "ecommerce_tables") {
            $('<li><a href="" id="' + niceKey + '"><span class="fa fa-bars"></span> ' + key + '</a></li>').appendTo('#menu #main ul#elements');
        }

        for (x = 0; x < _Elements.elements[key].length; x++) {

            //alert( data.elements[key][x].url )


            if (_Elements.elements[key][x].thumbnail == null) {//we'll need an section

                //build us some sections!

                newItem = $('<li class="element ' + niceKey + '"><section src="about:blank" scrolling="no"></section></li>');

                newItem.find('section').uniqueId();

                newItem.find('section').attr('src', _Elements.elements[key][x].url);

            } else {//we've got a thumbnail

                newItem = $('<li class="element ' + niceKey + '"><img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' + baseUrl + _Elements.elements[key][x].thumbnail + '" data-srcc="' + baseUrl + _Elements.elements[key][x].url + '" data-height="' + _Elements.elements[key][x].height + '"></li>');

            }

            newItem.appendTo('#menu #second ul#elements');

            //zoomer works

            if (_Elements.elements[key][x].height) {

                theHeight = _Elements.elements[key][x].height * 0.25;

            } else {

                theHeight = 'auto';

            }

            newItem.find('section').zoomer({
                zoom: 0.25,
                width: 270,
                height: theHeight,
                message: "Drag&Drop Me!"
            });

        }

        //draggables
        makeDraggable('#page1');

    }

    //main menu hide/show

    /* $('#menu').mouseenter(function() {
     
     $(this).stop().animate({'left': '0px'}, 500);
     
     }).mouseleave(function() {
     
     $(this).stop().animate({'left': '-190px'}, 500);
     
     });*/

    //use function call to make the ULs sortable
    makeSortable($('#pageList ul#page1'));

    //second menu animation		
    $('#menu #main #elements').on('click', 'a:not(.btn)', function() {

        $('#menu #main a').removeClass('active');
        $(this).addClass('active');

        //show only the right elements
        $('#menu #second ul li').hide();
        $('#menu #second ul li.' + $(this).attr('id')).show();

        if ($(this).attr('id') == 'all') {

            $('#menu #second ul li').show();

        }

        $('.menu .second').css('display', 'block').stop().animate({
            width: secondMenuWidth
        }, 500);

    });

    $('#menu #main #htmltemplates').on('click', 'a:not(.btn)', function() {

        $('#menu #main a').removeClass('active');
        $(this).addClass('active');

        // Show only the right elements
        $('#menu #second ul#htmltemplates li').hide();
        $('#menu #second ul#elements li').hide();
        $('#menu #second ul#htmltemplates li.' + $(this).attr('id')).show();

        if ($(this).attr('id') == 'all') {
            $('#menu #second ul#htmltemplates li').show();
        }

        $('.menu .second').css('display', 'block').stop().animate({
            width: secondMenuWidth
        }, 500);

    });

    //second nav hide button
    $('#menu').mouseleave(function() {

        $('#menu #main a').removeClass('active');

        $('.menu .second').stop().animate({
            width: 0
        }, 500, function() {

            $('#menu #second').hide();

        });

    });


    $('#menu #main').on('click', 'a:not(.actionButtons)', function(e) {

        e.preventDefault();

    });

    $('#menu').mouseleave(function() {

        $('#menu #main a').removeClass('active');

        $('.menu .second').stop().animate({
            width: 0
        }, 500, function() {

            $('#menu #second').hide();

        });

    });


    //disable on load
    $('input:radio[name=mode]').parent().addClass('disabled');
    $('input:radio[name=mode]#modeBlock').trigger('click');


    var elToUpdate;


    //design mode toggle
    $('input:radio[name=mode]').on('toggle', function() {


        if ($(this).val() == 'content') {

            //close style editor
            closeStyleEditor();
            $('[class^="html5gallery-car"]').show();
            //hide all section covers and activate designMode

            $('#pageList ul .frameCover').each(function() {
                $(this).hide();
            });

            $('.frameWrapper img').each(function() {
                if ($(this).hasClass('ui-resizable')) {
                    $(this).resizable("destroy");
                }
            });


            $(".drag").each(function() {
                if ($(this).hasClass('ui-draggable')) {
                    $(this).draggable("destroy");
                }
            });

            // spcl for portfolio templates
            $(".portfolio-list span").css("display", "block");
            //$(".pf").css({"width": "100%", "height": "auto"});

            //deactivate designmode
            $('#pageList ul li section').each(function() {

                for (var key in editableItems) {
                    $(this).find(key).unbind('mouseenter mouseleave');
                }

                this.designMode = "off";

            });

            $('#pageList ul li section').each(function() {

                //remove old click events

                for (var key in editableItems) {

                    $(this).find(key).unbind('hover').unbind('click');
                }
            });


            //active content edit mode
            $('#pageList ul li section').each(function() {


                for (i = 0; i < editableContent.length; ++i) {

                    //remove old events
                    $(this).find(editableContent[i]).unbind('click').unbind('hover');

                    $(this).find(editableContent[i]).hover(function() {

                        $(this).css({'outline': '3px dotted red', 'cursor': 'pointer'});

                    }, function() {

                        $(this).css({'outline': '', 'cursor': ''});

                    }).click(function(e) {

                        elToUpdate = $(this);

                        e.preventDefault();

                        e.stopPropagation();

                        $('#editContentModal #contentToEdit').val($(this).html());

                        $('#editContentModal').modal('show');

                        //for the elements below, we'll use a simplyfied editor, only direct text can be done through this one
                        if ($(this).hasClass('pprice')) {
                            $("#editContentModal #contentToEdit").on('keypress', function(e) {
                                //if the letter is not digit then don't type anything
                                if (e.which != 8 && e.which != 0 && e.which != 46 && e.which > 31 && (e.which < 48 || e.which > 57)) {
                                    return false;
                                }
                            });
                        }
                        else if (this.tagName == 'SMALL' || this.tagName == 'A' || this.tagName == 'SPAN' || this.tagName == 'B' || this.tagName == 'I' || this.tagName == 'EM' || this.tagName == 'STRONG' || this.tagName == 'SUB' || this.tagName == 'BUTTON' || this.tagName == 'LABEL')
                        {
                            $('#editContentModal #contentToEdit').redactor({
                                buttons: ['html', 'bold', 'italic', 'deleted', 'alignment'],
                                focus: true,
                                plugins: ['bufferbuttons'],
                                buttonSource: true,
                                paragraphize: false,
                                linebreaks: true,
                                enterKey: false,
                                toolbarFixed: false,
                                activeButtonsStates: {
                                    b: 'bold',
                                    i: 'italic',
                                    del: 'deleted',
                                    strike: 'deleted',
                                    ul: 'unorderedlist',
                                    ol: 'orderedlist',
                                    u: 'underline'
                                }
                            });
                        }
                        else {
                            $('#editContentModal #contentToEdit').redactor({
                                imageUpload: siteUrl + 'assets/imageUploadEditor/' + siteID,
                                clipboardUploadUrl: siteUrl + 'assets/imageUploadEditor/' + siteID,
                                focus: true,
                                plugins: ['table', 'bufferbuttons', 'video'],
                                buttonSource: true,
                                paragraphize: false,
                                linebreaks: true,
                                toolbarFixed: false,
                                replaceDivs: false
//                                deniedTags: ['br'],
                            });
                        }

                        /*if (this.tagName == 'SMALL' || this.tagName == 'A' || this.tagName == 'LI' || this.tagName == 'SPAN' || this.tagName == 'B' || this.tagName == 'I' || this.tagName == 'TT' || this.tageName == 'CODE' || this.tagName == 'EM' || this.tagName == 'STRONG' || this.tagName == 'SUB' || this.tagName == 'BUTTON' || this.tagName == 'LABEL' || this.tagName == 'P' || this.tagName == 'H1' || this.tagName == 'H2' || this.tagName == 'H2' || this.tagName == 'H3' || this.tagName == 'H4' || this.tagName == 'H5' || this.tagName == 'H6') {
                         console.log('1');
                         $('#editContentModal #contentToEdit').redactor({
                         buttons: ['html', 'bold', 'italic', 'deleted', 'link', 'rtl'],
                         focus: true,
                         plugins: ['bufferbuttons'],
                         buttonSource: true,
                         paragraphize: false,
                         linebreaks: true
                         });
                         
                         } else if (this.tagName == 'DIV' && $(this).hasClass('tableWrapper')) {
                         console.log('2');
                         $('#editContentModal #contentToEdit').redactor({
                         buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'table', 'image', 'link', 'alignment', 'rtl'],
                         focus: true,
                         plugins: ['table', 'bufferbuttons'],
                         buttonSource: true,
                         paragraphize: false,
                         linebreaks: false
                         });
                         
                         } else {
                         console.log('3');
                         $('#editContentModal #contentToEdit').redactor({
                         buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'outdent', 'indent', 'image', 'file', 'link', 'alignment', 'horizontalrule', 'rtl'],
                         focus: true,
                         buttonSource: true,
                         paragraphize: false,
                         linebreaks: false
                         });
                         }*/


                    }).each(function() {

                        $(this).attr('data-selector', key);

                    });

                }

            });


        } else if ($(this).val() == 'block') {

            //close style editor
            closeStyleEditor();

            //show all section covers and activate designMode

            $('#pageList ul .frameCover').each(function() {

                $(this).show();

            });

            $('.frameWrapper img').each(function() {
                if ($(this).hasClass('ui-resizable')) {
                    $(this).resizable("destroy");
                }
            });

            $(".drag").each(function() {
                if ($(this).hasClass('ui-draggable')) {
                    $(this).draggable("destroy");
                }
            });

            //deactivate designmode
            $('#pageList ul li section').each(function() {

                for (var key in editableItems) {

                    $(this).find(key).unbind('mouseenter mouseleave');

                }

                this.designMode = "off";

            });

        } else if ($(this).val() == 'styling') {

            //hide all section covers and activate designMode

            $('#pageList ul .frameCover').each(function() {

                $(this).hide();

            });

            $('#pageList ul li section').each(function() {

                for (i = 0; i < editableContent.length; ++i) {
                    //remove old events
                    $(this).find(editableContent[i]).unbind('click').unbind('hover');
                }
            });
            //active styling mode
            activeStyling();

            // spcl for portfolio templates
            $(".portfolio-list span").css("display", "none");
            $('[class^="html5gallery-car"]').hide();
        }
    });


    $('button#updateContentInFrameSubmit').click(function() {

        //alert( elToUpdate.text() )
        if (elToUpdate.hasClass('pprice') == true)
        {
            var text1 = $('#editContentModal #contentToEdit').val();

            var checkprice = /^\d+(\.\d{0,2})?$/;
            var pricevalid = checkprice.test(text1);

            if (pricevalid == false)
            {
                alert("Please enter only numbers");
                return false;
            }
            elToUpdate.html(text1).css({'outline': '', 'cursor': ''});
            $('#editContentModal #contentToEdit').val('');
        } else {
            elToUpdate.html($('#editContentModal #contentToEdit').redactor('code.get')).css({'outline': '', 'cursor': ''});
            $('#editContentModal textarea').each(function() {
//                $(this).redactor('core.destroy');
                $(this).val('');
            });
        }
        if (elToUpdate.has("table")) {
            elToUpdate.find("table").addClass("table table-bordered");
        }

        var text = elToUpdate.text();

        if (elToUpdate.hasClass('createproduct') == true)
        {
            //function to set values for product form 1
            updateproductinfo(elToUpdate, text);
        }

        $('#editContentModal').modal('hide');

        $(this).closest('div.wrap').removeClass('modal-open').attr('style', '');
        bootbox.confirm("Do you want to save updated text in database?", function(result) {
            // var text_data = $('#editContentModal #contentToEdit').redactor('code.get');
            if (result == true) {
                $.blockUI();
                $.ajax({
                    url: siteUrl + "sites/insert_block_content/",
                    type: "POST",
                    dataType: "json",
                    data: 'site_id=' + siteID + '&content=' + text,
                }).done(function(response) {
                    $.unblockUI();
                    if (response.responseCode == 1) {
                        $('#editContentModal #load_content').html($(response.responseHTML));
                        readmoreContent();
                    }
                });
            }
        });
        //element was deleted, so we've got pending changes
        setPendingChanges(true);

    });
    //set value for product no.1 //..............shubhangee
    function updateproductinfo(elToUpdate, text)
    {
        var elem = $(elToUpdate).parents('div.pricing1').children(':first-child').find('.productform1');

        if (elem.find('.productid').val() == "")
        {
            var randid = makeid();
            elem.find('.productid').val(randid);

            var redirecturl = siteUrl + "products/buynow?pid=" + randid;
            $(elToUpdate).parents('div.pricing1').children(':last-child').find('.buynowbtn').attr('href', redirecturl);
        }

        var productid = elem.find('.productid').val();

        if (elToUpdate.hasClass('pname') == true)
        {
            elem.find('.productname').val(text);
        }

        if (elToUpdate.hasClass('pprice') == true)
        {
            elem.find('.productprice').val(text);
        }

        if (elToUpdate.hasClass('pdescription') == true)
        {
            elem.find('.productdesc').val(text);
        }

        if (elem.find('.productname').val() == "")
        {
            var pname = $(elToUpdate).parents('div.pricing1').children(':first-child').find('.pname').text();
            elem.find('.productname').val(pname);
        }

        if (elem.find('.productprice').val() == "")
        {
            var pprice = $(elToUpdate).parents('div.pricing1').children(':first-child').find('.pprice').text();
            elem.find('.productprice').val(pprice);
        }

        if (elem.find('.productdesc').val() == "")
        {
            var desc = $(elToUpdate).parents('div.pricing1').children(':last-child').find('.pdescription').text();
            elem.find('.productdesc').val(desc);
        }

        var img1 = $(elToUpdate).parents('div.pricing1').children(':first-child').find('.img1').attr('src');

        var pprice = elem.find('.productprice').val();
        var pdescription = elem.find('.productdesc').val();
        var pname = elem.find('.productname').val();

        siteId = $('#pageList ul:visible').attr('data-siteid');

        $.ajax({
            url: siteUrl + "sites/createuserproducts/",
            type: "POST",
            dataType: "json",
            data: 'site_id=' + siteId + '&productid=' + productid + '&pname=' + pname + '&pprice=' + pprice + '&pdescription=' + pdescription + '&img1=' + img1,
        }).done(function(response) {
        });

    }

    //generate random id
    function makeid()
    {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 10; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

    //close styleEditor
    $('#styleEditor > a.close').click(function(e) {

        e.preventDefault();

        closeStyleEditor();

    });


    //delete blocks from window

    var blockToDelete;

    $('#pageList').on("click", ".frameCover > .deleteBlock", function() {

        $('#deleteBlock').modal('show');

        blockToDelete = $(this).closest('li');

        $('#deleteBlock').off('click', '#deleteBlockConfirm').on('click', '#deleteBlockConfirm', function() {

            $('#deleteBlock').modal('hide');

            blockToDelete.fadeOut(500, function() {

                $(this).remove();

                pageEmpty();

                allEmpty();

                setPendingChanges(true);

            });

        });

    });


    //reset block
    $('#pageList').on("click", ".frameCover > .resetBlock", function() {

        $('#resetBlock').modal('show');

        frameToReset = $(this).closest('li').find('section:first');

        $('#resetBlock').off('click', '#resetBlockConfirm').on('click', '#resetBlockConfirm', function() {

            $('#resetBlock').modal('hide');
            $.ajax({
                type: "POST",
                url: frameToReset.attr('src'),
                beforeSend: function() {
                    frameToReset.html('');
                    frameToReset.css('background', '#ffffff url(' + baseUrl + 'assets/sites/images/loading.gif) 50% 50% ui.i no-repeat');
                },
                success: function(data) {
                    frameToReset.css('background-image', 'none');
                    frameToReset.html('');
                    frameToReset.html(data);
                    frameToReset.find('[class^="html5gallery-container"]').remove();
                    frameToReset.find(".html5gallery").html5gallery();
                }
            });
            setPendingChanges(true);
        });

    });


    var aceEditors = new Array();//store all ace editors


    //block source code
    $('#pageList').on("click", ".frameCover > .htmlBlock", function() {

        //hide the section
        $(this).closest('.li').find('section:first').hide();


        //disable draggable on the LI
        $(this).closest('li').parent().sortable('disable');


        //built editor element
        theEditor = $('<div class="aceEditor"></div>');
        theEditor.uniqueId();

        //set the editor height
        theEditor.height($(this).closest('li').height());

        $(this).closest('li').append(theEditor);

        theId = theEditor.attr('id');

        var editor = ace.edit(theId);

        editor.setValue($(this).closest('li').find('section:first').find(pageContainer).html());

        editor.setTheme("ace/theme/twilight");
        editor.getSession().setMode("ace/mode/html");

        //buttons

        cancelButton = $('<button type="button" class="btn btn-danger editCancelButton btn-wide"><span class="fui-cross"></span> Cancel</button>');
        saveButton = $('<button type="button" class="btn btn-primary editSaveButton btn-wide"><span class="fui-check"></span> Save</button>');

        buttonWrapper = $('<div class="editorButtons"></div>');
        buttonWrapper.append(cancelButton);
        buttonWrapper.append(saveButton);

        $(this).closest('li').append(buttonWrapper);

        aceEditors[ theId ] = editor;

    });


    $('#pageList').on("click", "li .editorButtons .editCancelButton", function() {

        //theId = $(this).closest('.editorButtons').prev().attr('id');

        //enable draggable on the LI
        $(this).closest('li').parent().sortable('enable');

        $(this).parent().prev().remove();

        $(this).closest('li').find('.zoomer-small section').fadeIn(500);

        $(this).parent().fadeOut(500, function() {

            $(this).remove();

        });

    });


    $('#pageList').on("click", "li .editorButtons .editSaveButton", function() {

        //enable draggable on the LI
        $(this).closest('li').parent().sortable('enable');

        theId = $(this).closest('.editorButtons').prev().attr('id');

        theContent = aceEditors[theId].getValue();

        theiFrame = $(this).closest('li').find('section:first');

        $(this).parent().prev().remove();


        //theiFrame.contents().find( pageContainer ).html( theContent );

        //height adjustment
        heightAdjustment($(this).closest('li').find('section:first').attr('id'), true);


        $(this).parent().fadeOut(500, function() {

            $(this).remove();

        });

        setPendingChanges(true);

    });

    function ajaxSave_op(theData) {
        $.blockUI();
        $.ajax({
            url: siteUrl + "sites/save",
            type: "POST",
            dataType: "json",
            data: theData,
        }).done(function(res) {
            $.unblockUI();
            //enable button
            $("a#savePage").removeClass('disabled');
            if (res.responseCode == 0) {
                $('#massageDialog .modal-body').append($(res.responseHTML));
                $('#massageDialog').modal('show');

            } else if (res.responseCode == 1) {
                $('#massageDialog .modal-body').append($(res.responseHTML));
                $('#massageDialog').modal('show');
                siteID = res.siteID;
                if (res.path_pdf) {
                    $('#pdf_path_flag').remove();
                    $('#pdfs').append('<a href="' + res.path_pdf + '" id="pdf_path_flag" target="_blank">Click here for Previous Content</a>');
                }
                //no more pending changes
                setPendingChanges(false);
            }

        });
    }

    //save page
    $('#savePage').click(function(e) {

        $('input:radio[name=mode]#modeBlock').trigger('click');
//        savePage(e);
        closeStyleEditor();
        //disable button
        $("a#savePage").addClass('disabled');
        //remove old alerts
        $('#massageDialog .modal-body > *').each(function() {
            $(this).remove();
        });
        thePages = prepPagesforSave();
        if (typeof pagesData !== 'undefined') {
            theData = {
                pageData: thePages,
                siteName: $('#siteTitle').text(),
                siteID: siteID,
                pagesData: pagesData
            };
        } else {
            theData = {
                pageData: thePages,
                siteName: $('#siteTitle').text(),
                siteID: siteID
            };

        }
//        console.log(theData);
        if (pdf_flag == 0) {
            ajaxSave_op(theData);
        } else {
            bootbox.confirm("Do you want to save? If you press Ok your old pdf content Will be Deleted.", function(result) {
                // var text_data = $('#editContentModal #contentToEdit').redactor('code.get');
                if (result == true) {
                    ajaxSave_op(theData);
                }
            });
        }
    });

    $("#take_template").validate({
        onfocusout: false,
        onkeyup: false,
        rules: {
            template_name: {
                required: true
            },
            cate_select: {
                required: true
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.closest("form"));
        },
        messages: {
            template_name: {
                required: "We need template Name",
                template_name: "Please, enter a valid name"

            },
            cate_select: {
                required: "We need Category",
                category_name: "Please, enter a valid Category"

            }

        },
        highlight: function(element) {
            $(element)
        },
        success: function(element) {
            element.text('').addClass('valid');

        }

    });
    function ajax_saveTemplate(theData) {

        $.ajax({
            url: siteUrl + "sites/save_template",
            type: "POST",
            dataType: "json",
            data: theData,
        }).done(function(res) {
            $('#savetemplate').attr('disabled', false);
            $('#myModal_temp .loader').hide();
            //enable button
            $("a#savetemplate").removeClass('disabled');
            $('#myModal_temp').modal('hide');
            if (res.responseCode == 0) {
                $('#massageDialog .modal-body').append($(res.responseHTML));
                $('#massageDialog').modal('show');
            } else if (res.responseCode == 1) {

                $('#massageDialog .modal-body').append($(res.responseHTML));
                $('#massageDialog').modal('show');
                setPendingChanges(false);
//                setTimeout(function() {
//                    window.location.assign(siteUrl + 'sites/templates');
//                }, 100);
            }
        });
    }
    //save as template
    $('#savetemplate').click(function(e) {
        $('#savetemplate').attr('disabled', true);
        thePages = prepPagesforSave();
        if ($('#take_template').valid()) {
            $('input:radio[name=mode]#modeBlock').trigger('click');
            closeStyleEditor();
            //disable button
            $("a#savetemplate").addClass('disabled');
            //remove old alerts
            $('#massageDialog .modal-body > *').each(function() {
                $(this).remove();
            });
            $('#temp_error').empty();
            var template_name = $('input[name="template_name"]').val();
            var category_id = $("#cate_select option:selected").val();
            $('#myModal_temp .loader').show();
            if (templateID == null || templateID == 'undefined' || templateID == '') {
                $.ajax({
                    url: siteUrl + "sites/check_template_name",
                    type: "POST",
                    dataType: "json",
                    encode: true,
                    data: {'template_name': template_name, 'category_id': category_id}
                }).done(function(data_res) {
                    $('#myModal_temp .loader').hide();
                    if (data_res.responseCode == 0) {
                        //if template name and catgory both present in db ask for new template name
                        $('#temp_error').append(data_res.responseMSG);
                        $('#myform_template_category').removeClass('help.block').addClass('has-error');
                        return false;
                    } else {
                        $('#temp_error').empty();
                        if (typeof pagesData !== 'undefined') {

                            theData = {template_element: thePages, template_name: template_name, category_id: category_id, pagesData: pagesData, img_url: $('#img_val').val()};
                        } else {

                            theData = {template_element: thePages, template_name: template_name, category_id: category_id, img_url: $('#img_val').val()};
                        }
                        $('#myModal_temp .loader').show();
                        ajax_saveTemplate(theData);
                    }
                });
            } else {
                $('#temp_error').empty();
                if (typeof pagesData !== 'undefined') {

                    theData = {templateID: templateID, template_element: thePages, template_name: template_name, category_id: category_id, pagesData: pagesData, img_url: $('#img_val').val()};
                } else {

                    theData = {templateID: templateID, template_element: thePages, template_name: template_name, category_id: category_id, img_url: $('#img_val').val()};
                }
                $('#myModal_temp .loader').show();
                ajax_saveTemplate(theData);
            }

        } else {
            e.preventDefault();
            return false;
        }
    });


    //preview
    $('#previewModal').on('show.bs.modal', function(e) {

        $('#previewModal > form #showPreview').show('');

        $('#previewModal > form #previewCancel').text('Cancel & Close');

        closeStyleEditor();

    });

    $('#previewModal').on('shown.bs.modal', function(e) {

        $('#previewModal form input[type="hidden"]').remove();

        $(".modes label:nth-of-type(2)").click();

        //grab visible page
        $('#pageList > ul:visible').each(function() {

            //grab the skeleton markup

            newDocMainParent = $('iframe#skeleton').contents().find(pageContainer);

            //empty out the skeleton
            newDocMainParent.find('*').remove();

            $(this).find('section').each(function() {

                theContents = $(this).find(pageContainer);

                //remove .frameCovers

                theContents.find('.frameCover').each(function() {
                    $(this).hide();
                });

                //remove inline styling leftovers

                for (var key in editableItems) {

                    //alert('Key :'+key)

                    theContents.find(key).each(function() {

                        //alert( "Data before: "+ $(this).attr('data-selector') );
                        // TODO: It realy need?
                        $(this).removeAttr('data-selector');

                        //alert( "Data after: "+ $(this).attr('data-selector') );

                        if ($(this).attr('style') == '') {
                            $(this).removeAttr('style');
                        }

                    });

                }
                // TODO: It realy need?
                for (i = 0; i < editableContent.length; ++i) {

                    $(this).find(editableContent[i]).each(function() {

                        $(this).removeAttr('data-selector');

                    });

                }

                toAdd = theContents.html();

                //grab scripts

                scripts = $(this).contents().find(pageContainer).find('script');

                if (scripts.size() > 0) {

                    theIframe = document.getElementById("skeleton");

                    scripts.each(function() {

                        if ($(this).text() != '') {//script tags with content

                            var script = theIframe.contentWindow.document.createElement("script");
                            script.type = 'text/javascript';
                            script.innerHTML = $(this).text();

                            theIframe.contentWindow.document.getElementById(pageContainer.substring(1)).appendChild(script);

                        } else if ($(this).attr('src') != null) {

                            var script = theIframe.contentWindow.document.createElement("script");
                            script.type = 'text/javascript';
                            script.src = $(this).attr('src');

                            theIframe.contentWindow.document.getElementById(pageContainer.substring(1)).appendChild(script);

                        }

                    });

                }

                newDocMainParent.append($(toAdd));

            });

            newInput = $('<input type="hidden" name="page" value="">');
            siteInput = $('<input type="hidden" name="siteID" value="">');

            $('#previewModal form').prepend(newInput);
            $('#previewModal form').prepend(siteInput);

            newInput.val("<!DOCTYPE html><html>" + $('iframe#skeleton').contents().find('html').html() + "</html>");
            siteInput.val(siteID);

        });

    });

    $('#previewModal > form').submit(function() {

        $('#previewModal > form #showPreview').hide('');

    });

    //export Project

    $('#projModal').on('show.bs.modal', function() {
        if (!emptyMarker) {
            $("#saveprojPage").removeClass("disabled");
        } else {
            $("#saveprojPage").addClass("disabled");
        }
    });



    $("#markFormImp").submit(function() {

        $(this).ajaxSubmit({
            success: function(response) {
                var answer = JSON.parse(response),
                        LSIndex = 1;
                if (answer.error != '') {
                    $("#massageDialog .modal-body").html(answer.error);
                    $("#deleteAllPages").modal('hide');
                    $("#massageDialog").modal('show');
                } else {
                    var data = JSON.parse(answer.data),
                            lengthBlocks = data.length - 1;
                    window.localStorage.clear();
                    for (var x = 0; x < lengthBlocks; x = x + 2) {
                        window.localStorage['blocksElement' + LSIndex] = JSON.stringify(data[x]);
                        LSIndex++;
                    }
                    LSIndex = 1;

                    for (var x = 1; x < lengthBlocks; x = x + 2) {
                        window.localStorage['blocksFrame' + LSIndex] = JSON.stringify(data[x]);
                        LSIndex++;
                    }
                    window.localStorage['pageNames'] = JSON.stringify(data[lengthBlocks]);
                    location.reload();
                }
            }
        });
        return false;
    });

    $("#saveprojPage").on('click', function(e) {
        var exp = new Object(),
                jsonData = [],
                x = 0;
        savePage(e, exp);
        for (key in exp) {
            jsonData[x] = exp[key];
            x++;
        }

        $("#dataProject").val(JSON.stringify(jsonData));
        //$("#dataProject").attr({"value": JSON.stringify(jsonData)});

        $("#markFormExp").submit();
    });
    $('#fileinput').on('change', function() {
        $("#deleteAllPages").modal('show');
        $("#projModal").modal('hide');
    });

    $("#deleteAPForImport").on('click', function() {
        $("#markFormImp").submit();
    });


    //clear screen
    $('#clearScreen').click(function() {

        $('#deleteAll').modal('show');

        $('#deleteAll').on('click', '#deleteAllConfirm', function() {

            $('#deleteAll').modal('hide');

            $('#pageList ul:visible li').fadeOut(500, function() {

                $(this).remove();

                pageEmpty();

                allEmpty();

            });

        });

        for (x = 0; x <= 99; x++) {

            localStorage.removeItem("blocksElement" + x);
            localStorage.removeItem("blocksFrame" + x);

        }
        setPendingChanges(true);

        closeStyleEditor();
        $('input:radio[name=mode]#modeBlock').trigger('click');
    });


    //page menu buttons

    // scrollbar

    $('.scrollbar-inner').niceScroll({
        cursorcolor: "#AEAEAE",
        cursoropacitymin: 0,
        cursoropacitymax: 0.7,
        cursorborder: "none",
        scrollspeed: 70,
        cursorborderradius: "6px",
        cursorwidth: "6px",
        mousescrollstep: 70,
        autohidemode: "leave",
        railpadding: {top: 0, right: 2, left: 0, bottom: 2}
    });

    //add page

    $('#pages').on('blur', 'li > input', function() {

        if ($(this).parent().find('a.plink').size() == 0) {

            theLink = $('<a href="#' + $(this).val() + '" class="plink">' + $(this).val() + '</a>');

            $(this).hide();

            $(this).closest('li').prepend(theLink);

            $(this).closest('li').removeClass('edit');

            //update the page dropdown

            $('#internalLinksDropdown option:eq(' + $(this).parent().index() + ')').text($(this).val()).attr('value', $(this).val() + ".html");

            $('select#internalLinksDropdown').selectpicker({style: 'btn-sm btn-default', menuStyle: 'dropdown-inverse'})

            //alert( ($(this).parent().index())+" : "+$(this).val() )


            $(this).remove();

        }

    });

    $('#addPage').click(function(e) {

        e.preventDefault();
        if (domain_ok != 1) {
            alert("Please, first set your URL settings from settings tab!");
            e.stopImmediatePropagation();
            return;
        }
        //turn inputs into links
        $('#pages li.active').each(function() {

            if ($(this).find('input').size() > 0) {

                theLink = $('<a href="#">' + $(this).find('input').val() + '</a>');

                $(this).find('input').remove();

                $(this).prepend(theLink);

            }

        });

        $('#pages li').removeClass('active');

        newPageLI = $('#newPageLI').clone();
        newPageLI.css('display', 'block');
        newPageLI.find('input').val('page' + $('#pages li').size());
        newPageLI.attr('id', '');

        $('ul#pages').append(newPageLI);

        theInput = newPageLI.find('input');

        theInput.focus();

        var tmpStr = theInput.val();
        theInput.val('');
        theInput.val(tmpStr);

        theInput.keyup(function() {

            $('#pageTitle span span').text($(this).val());

        });

        newPageLI.addClass('active').addClass('edit');

        var navigationStart = '<li class="element navigation " style="display: list-item; height: auto;">';
        var navigationEnd = '</li>';
        var navigation = '';
        var footerStart = '<li class="element footer " style="display: list-item; height: auto;">';
        var footerEnd = '</li>';
        var footer = '';

        //Copy navigation elements
        $('#pageList ul:first > li').each(function() {
            if ($(this).hasClass('navigation')) {
                navigation = navigationStart + $(this).html() + navigationEnd;
            }
            if ($(this).hasClass('footer')) {
                footer = footerStart + $(this).html() + footerEnd;
            }
        });

        //create the page structure
        newPageList = $('<ul>' + navigation + footer + '</ul>');
        newPageList.css('display', 'block');
        newPageList.attr('id', 'page' + ($('#pages li').size() - 1));

        $('#pageList > ul').hide();
        $('#pageList').append(newPageList);

        makeSortable(newPageList);

        //draggables
        makeDraggable('#' + 'page' + ($('#pages li').size() - 1));

        //alter page title
        $('#pageTitle span span').text('page' + ($('#pages li').size() - 1));

        $('#frameWrapper').addClass('empty');
//        $('#start').fadeIn();

        //add page to page dropdown

        newItem = $('<option value="' + 'page' + ($('#pages li').size() - 1) + '.html">' + 'page' + ($('#pages li').size() - 1) + '</option>');

        $('#internalLinksDropdown').append(newItem);

        $('select#internalLinksDropdown').selectpicker({style: 'btn-sm btn-default', menuStyle: 'dropdown-inverse'});

        //new page added, we've got pending changes
        setPendingChanges(true);

    });


    $('#pages').on('click', 'li:not(.active)', function() {

        $('#pageList > ul').hide();

        $('#pageList > ul:eq(' + ($(this).index() - 1) + ')').show();

        pageEmpty();

        //draggables
        makeDraggable('#' + 'page' + ($(this).index()));

        $('#pages li').removeClass('active').removeClass('edit');

        $(this).addClass('active');

        $('#pageTitle span span').text($(this).find('a').text());

    });


    $('#pages').on('click', 'li.active .fileSave', function() {

        //do something

        theLI = $(this).closest('li');

        //make sure the new page name is unique 

        if ($("#pages li > a:contains('" + theLI.find('input').val() + "')").size() == 0) {

            if (theLI.find('input').size() > 0) {

                theLink = $('<a href="#' + theLI.find('input').val() + '">' + theLI.find('input').val() + '</a>');

                theLI.find('input').remove();

                theLI.prepend(theLink);

            }

            $('#pages li').removeClass('edit');

        } else {

            alert('Please sure your new page has a unique name');

        }

    });


    //edit page button

    $('#pages').on('click', 'li.active .fileEdit', function() {

        theLI = $(this).closest('li');

        newInput = $('<input type="text" value="' + theLI.find('a:first').text() + '" name="page">');

        theLI.find('a:first').remove();

        theLI.prepend(newInput);

        newInput.focus();

        var tmpStr = newInput.val();
        newInput.val('');
        newInput.val(tmpStr);

        newInput.keyup(function() {

            $('#pageTitle span span').text($(this).val());

        });

        theLI.addClass('edit');

        //changed page title, we've got pending changes
        setPendingChanges(true);

    });

    var theLIIndex;

    //delete page button
    $('#pages').on('click', 'li.active .fileDel', function() {

        theLIIndex = $(this).parent().parent().index();

        $('#deletePage').modal('show');

        $('#deletePageCancel').click(function() {

            $('#deletePage').modal('hide');

        });

        $('#deletePage').off('click').on('click', '#deletePageConfirm', function(e) {

            $('#deletePage').modal('hide');

            $('#pages li:eq(' + theLIIndex + ')').remove();

            pageName = $('#pageList ul:visible').attr('data-pagename');
            siteId = $('#pageList ul:visible').attr('data-siteid');

            $.ajax({
                url: siteUrl + "sites/page_delete/",
                type: "POST",
                dataType: "json",
                data: 'site_id=' + siteId + '&page_name=' + pageName,
            }).done(function() {
                $('#pageList ul:visible').remove();

                //update the page dropdown list
                $('select#internalLinksDropdown option:eq(' + theLIIndex + ')').remove();

                $('.link_Tab .dropdown-menu li:eq(' + theLIIndex + ')').remove();

                //activate the first page
                $('#pages li:eq(1)').addClass('active');
                $('#pageList ul:first').show();
                $('#pageTitle span span').text($('#pages li:eq(1)').find('a:first').text())

                //draggables
                makeDraggable('#' + 'page1');

                //show the start block?
                pageEmpty();

                allEmpty();

                //page was deleted, so we've got pending changes
                setPendingChanges(true);
            });

        });

    });

//copy page button
    $('#pages').on('click', 'li.active .fileCopy', function() {

        theLI = $(this).closest('li');

        newInput = $('<input type="text" id="copy" value="' + theLI.find('a:first').text() + '.html' + '" name="page">');
        theLI.find('a:first').remove();
        theLI.prepend(newInput);
        document.getElementById('copy').select();
        document.execCommand('copy');
        str = document.getElementById('copy').value;
        str1 = str.slice(0, -5);
        $('#copy:text').val(str1);
        theLI.addClass('edit');

        alert("URL Copied !");
    });

    //content modal, destroy redactor when modal closes
    $('#editContentModal').on('hidden.bs.modal', function(e) {

        $('#editContentModal #contentToEdit').redactor('core.destroy');

    });


    /*
     
     site publishing
     
     */

    //publish modal
    $('#publishPage').click(function(e) {

        e.preventDefault();
//        $('input:radio[name=mode]#modeBlock').trigger('click');
        $(".modes label:nth-of-type(2)").click();

        if (publishActive == 0) {//check if we're currently publishing anything

            //hide alerts
            $('#publishModal .modal-alerts > *').each(function() {
                $(this).remove();
            });

            $('#publishModal .modal-body > .alert-success').hide();

            //hide loaders
            $('#publishModal_assets .publishing').each(function() {

                $(this).hide();
                $(this).find('.working').show();
                $(this).find('.done').hide();

            });

            //remove published class from asset checkboxes
            $('#publishModal_assets input').each(function() {
                $(this).removeClass('published');
            });

            //do we have pending changes?

            if (pendingChanges == true) {//we've got changes, save first

                $('#publishModal #publishPendingChangesMessage').show();
                $('#publishModal .modal-body-content').hide();

            } else {//all set, get on it with publishing

                //get the correct pages in the Pages section of the publish modal

                $('#publishModal_pages tbody > *').remove();

                $('#pages li:visible').each(function() {

                    thePage = $(this).find('a:first').text();

                    theRow = $('<tr><td class="text-center" style="width: 0px;"><label class="checkbox"><input type="checkbox" value="' + thePage + '" id="" data-type="page" name="pages[]" data-toggle="checkbox"></label></td><td>' + thePage + '<span class="publishing"><span class="working">Publishing... <img src="' + baseUrl + 'assets/sites/images/publishLoader.gif"></span><span class="done text-primary">Published &nbsp;<span class="fui-check"></span></span></span></td></tr>');

                    //checkboxify
                    theRow.find('input').checkbox();

                    theRow.find('input').on('check uncheck toggle', function() {

                        $(this).closest('tr')[$(this).prop('checked') ? 'addClass' : 'removeClass']('selected-row');

                    });

                    $('#publishModal_pages tbody').append(theRow);

                });

                $('#publishModal #publishPendingChangesMessage').hide();
                $('#publishModal .modal-body-content').show();

            }

        }

        //enable/disable publish button
        activateButton = false;

        $('#publishModal input[type=checkbox]').each(function() {

            if ($(this).prop('checked')) {

                activateButton = true;

                return false;

            }

        });

        if (activateButton) {

            $('#publishSubmit').removeClass('disabled');

        } else {

            $('#publishSubmit').addClass('disabled');

        }

        $('#publishModal').modal('show');

    });


    //save site before publishing
    $('#publishModal #publishPendingChangesMessage .btn.save').click(function() {

        $('#publishModal #publishPendingChangesMessage').hide();

        $('#publishModal .loader').show();


        $(this).addClass('disabled');

        thePages = prepPagesforSave();


        $.ajax({
            url: siteUrl + "sites/save/1",
            type: "POST",
            dataType: "json",
            data: {pageData: thePages, siteName: $('#siteTitle').text(), siteID: siteID},
        }).done(function(res) {

            $('#publishModal .loader').fadeOut(500, function() {

                $('#publishModal .modal-alerts').append($(res.responseHTML));

                //self-destruct success messages
                setTimeout(function() {
                    $('#publishModal .modal-alerts .alert-success').fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 2500);

                //enable button
                $('#publishModal #publishPendingChangesMessage .btn.save').removeClass('disabled');

            });

            if (res.responseCode == 1) {//changes were saved without issues

                //no more pending changes
                setPendingChanges(false);

                //get the correct pages in the Pages section of the publish modal

                $('#publishModal_pages tbody > *').remove();

                $('#pages li:visible').each(function() {

                    thePage = $(this).find('a:first').text();

                    theRow = $('<tr><td class="text-center" style="width: 0px;"><label class="checkbox"><input type="checkbox" value="' + thePage + '" id="" data-type="page" name="pages[]" data-toggle="checkbox"></label></td><td>' + thePage + '<span class="publishing"><span class="working">Publishing... <img src="' + baseUrl + 'images/publishLoader.gif"></span><span class="done text-primary">Published &nbsp;<span class="fui-check"></span></span></span></td></tr>');

                    //checkboxify
                    theRow.find('input').checkbox();

                    theRow.find('input').on('check uncheck toggle', function() {

                        $(this).closest('tr')[$(this).prop('checked') ? 'addClass' : 'removeClass']('selected-row');

                    });

                    $('#publishModal_pages tbody').append(theRow);

                });


                //show content
                $('#publishModal .modal-body-content').fadeIn(500);

            }

        });

    });


    //listen for checkboxes
    $('#publishModal').on('change', 'input[type=checkbox]', function() {

        activateButton = false;

        $('#publishModal input[type=checkbox]').each(function() {

            if ($(this).prop('checked')) {

                activateButton = true;

                return false;

            }

        });

        if (activateButton) {

            $('#publishSubmit').removeClass('disabled');

        } else {

            $('#publishSubmit').addClass('disabled');

        }

    });



    //submit publish
    $('#publishSubmit').click(function() {
        $(".modes label:nth-of-type(2)").click();
        //track the publishing state
        publishActive = 1;

        //disable button
        $('#publishSubmit, #publishCancel').addClass('disabled');

        //remove existing alerts
        $('#publishModal .modal-alerts > *').remove();

        //prepare stuff
        $('#publishModal form input[type="hidden"].page').remove();

        //loop through all pages
        $('#pageList > ul').each(function() {

            //export this page?
            if ($('#publishModal #publishModal_pages input:eq(' + ($(this).index() + 1) + ')').prop('checked')) {
                //grab the skeleton markup
                newDocMainParent = $('iframe#skeleton').contents().find(pageContainer);

                //empty out the skeleton
                newDocMainParent.find('*').remove();

                //loop through page sections and grab the body stuff

                $(this).find('li > section').each(function() {

                    //remove .frameCovers

                    theContents = $(this).find(pageContainer);

                    theContents.find('.frameCover').each(function() {
                        $(this).remove();
                    });

                    toAdd = theContents.html();

                    newDocMainParent.append($(toAdd));

                });

                //theStyle = $('<style>body{width:100%}</style>');

                //$('iframe#skeleton').contents().find('head').append( $('<style>body{width:100%}</style>') )

                //create the hidden input

                //alert( $('#pages li:eq('+$(this).index()+1+') a:first').text() )

                newInput = $('<input type="hidden" class="page" name="xpages[' + $('#pages li:eq(' + ($(this).index() + 1) + ') a:first').text() + ']" value="">');

                $('#publishModal form').prepend(newInput);

                newInput.val("<html>" + $('iframe#skeleton').contents().find('html').html() + "</html>");

            }

        });


        //we'll publish everything item by item, to prevent time outs and to give somewhat of an indication

        publishAsset();

    });

    //image uploading

    $('input#imageFile').change(function() {

        if ($(this).val() == '') {

            //no file, disable submit button
            $('button#uploadImageButton').addClass('disabled');

        } else {

            //got a gile, enable button
            $('button#uploadImageButton').removeClass('disabled');

        }

    });

    //image uploading

    $('input#videoFile').change(function() {

        if ($(this).val() == '') {

            //no file, disable submit button
            $('button#uploadVideoButton').addClass('disabled');

        } else {

            //got a gile, enable button
            $('button#uploadVideoButton').removeClass('disabled');

        }

    });


    $('button#uploadImageButton').click(function() {

        if ($('input#imageFile').val() != '') {

            //remove old alerts
            $('#imageModal .modal-alerts > *').remove();

            //disable button
            $('button#uploadImageButton').addClass('disabled');

            //show loader
            $('#imageModal .loader').fadeIn(500);

            var form = $('form#imageUploadForm');

            var formdata = false;

            if (window.FormData) {
                formdata = new FormData(form[0]);
            }

            var formAction = form.attr('action');

            $.ajax({
                url: formAction,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                type: 'POST',
            }).done(function(ret) {

                //enable button
                $('button#uploadImageButton').addClass('disabled');

                //hide loader
                $('#imageModal .loader').fadeOut(500);

                if (ret.responseCode == 0) {//error

                    $('#imageModal .modal-alerts').append($(ret.responseHTML));

                } else if (ret.responseCode == 1) {//success

                    //append my images
                    $('#myImagesTab > #myImages').remove();
                    $('#myImagesTab .alert').remove();
                    $('#myImagesTab').append($(ret.myImages));

                    $('#imageModal .modal-alerts').append($(ret.responseHTML));

                    setTimeout(function() {
                        $('#imageModal .modal-alerts > *').fadeOut(500);
                    }, 3000);

                    $('#uploadTab').find('a.fileinput-exists').click();
                }

            });

        } else {

            alert('No image selected');

        }

    });

    $('button#uploadVideoButton').click(function() {

        if ($('input#videoFile').val() != '') {

            //remove old alerts
            $('#videoModal .modal-alerts > *').remove();

            //disable button
            $('button#uploadVideoButton').addClass('disabled');

            //show loader
            $('#videoModal .loader').fadeIn(500);

            var form = $('form#videoUploadForm');

            var formdata = false;

            if (window.FormData) {
                formdata = new FormData(form[0]);
            }

            var formAction = form.attr('action');

            $.ajax({
                url: formAction,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                type: 'POST'
            }).done(function(ret) {

                //enable button
                $('button#uploadVideoButton').addClass('disabled');

                //hide loader
                $('#videoModal .loader').fadeOut(500);

                if (ret.responseCode == 0) {//error

                    $('#videoModal .modal-alerts').append($(ret.responseHTML));

                } else if (ret.responseCode == 1) {//success

                    //append my images
                    $('#myVideosTab > *').remove();
                    $('#myVideosTab').append($(ret.myVideos));
                    $(".videoGallery").html5gallery();
                    $('#videoModal .modal-alerts').append($(ret.responseHTML));

                    setTimeout(function() {
                        $('#videoModal .modal-alerts > *').fadeOut(500);
                    }, 3000);

                    $('#uploadVideoTab').find('a.fileinput-exists').click();
                }
            });
        } else {
            alert('No video selected');
        }

    });

    //update page settings
    $('button#pageSettingsSubmittButton').click(function() {

        //disable button
        $(this).addClass('disabled');

        //hide old alerts
        $('#pageSettingsModal .modal-alerts > *').remove();

        //show loader
        $('#pageSettingsModal .loader').fadeIn(500);

        $.ajax({
            url: $('form#pageSettingsForm').attr('action'),
            type: 'post',
            data: $('form#pageSettingsForm').serialize(),
            dataType: 'json'
        }).done(function(ret) {

            //enable button
            $('button#pageSettingsSubmittButton').removeClass('disabled');

            //hide loader
            $('#pageSettingsModal .loader').hide();

            if (ret.responseCode == 0) {//error

                $('#pageSettingsModal .modal-alerts').append($(ret.responseHTML));

            } else {//success

                $('#pageSettingsModal .modal-alerts').append($(ret.responseHTML));
                $('#siteTitle').text(ret.siteName);
                $('#site_' + ret.siteID + ' .window .top b').text(ret.siteName);
                //self destruct success alert
                setTimeout(function() {
                    $('#pageSettingsModal .modal-alerts > *').fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 3000);

                if (typeof ret.pagesData !== 'undefined') {

                    //updates pagesData array
                    pagesData = ret.pagesData;

                }

            }

        });

    });

});

var publishActive = 0;
var theItem;

function publishAsset() {

    toPublish = $('#publishModal_assets input[type=checkbox]:checked:not(.published, .toggleAll), #publishModal_pages input[type=checkbox]:checked:not(.published, .toggleAll)');

    if (toPublish.size() > 0) {

        theItem = toPublish.first();

        //display the asset loader
        theItem.closest('td').next().find('.publishing').fadeIn(500);

        if (theItem.attr('data-type') == 'page') {

            theData = {siteID: $('form#publishForm input[name=siteID]').val(), item: theItem.val(), pageContent: $('form#publishForm input[name="xpages[' + theItem.val() + ']"]').val()};

        } else if (theItem.attr('data-type') == 'asset') {

            theData = {siteID: $('form#publishForm input[name=siteID]').val(), item: theItem.val()};

        }

        $.ajax({
            url: $('form#publishForm').attr('action'),
            type: 'post',
            data: theData,
            dataType: 'json',
        }).done(function(ret) {

            if (ret.responseCode == 0) {//fatal error, publishing will stop

                //hide indicators
                theItem.closest('td').next().find('.working').hide();

                //enable buttons
                $('#publishSubmit, #publishCancel').removeClass('disabled');

                $('#publishModal .modal-alerts').append($(ret.responseHTML));

            } else if (ret.responseCode == 1) {//no issues

                //show done
                theItem.closest('td').next().find('.working').hide();
                theItem.closest('td').next().find('.done').fadeIn();

                theItem.addClass('published');

                publishAsset();

            }

        });

    } else {

        //publishing is done

        publishActive = 0;

        //enable buttons
        $('#publishSubmit, #publishCancel').removeClass('disabled');


        //show message
        $('#publishModal .modal-body > .alert-success').fadeIn(500, function() {

            setTimeout(function() {
                $('#publishModal .modal-body > .alert-success').fadeOut(500)
            }, 2500);

        });

    }

}

(function($) {
    if ($.fn.style) {
        return;
    }

    // Escape regex chars with \
    var escape = function(text) {
        return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    };

    // For those who need them (< IE 9), add support for CSS functions
    var isStyleFuncSupported = !!CSSStyleDeclaration.prototype.getPropertyValue;
    if (!isStyleFuncSupported) {
        CSSStyleDeclaration.prototype.getPropertyValue = function(a) {
            return this.getAttribute(a);
        };
        CSSStyleDeclaration.prototype.setProperty = function(styleName, value, priority) {
            this.setAttribute(styleName, value);
            var priority = typeof priority != 'undefined' ? priority : '';
            if (priority != '') {
                // Add priority manually
                var rule = new RegExp(escape(styleName) + '\\s*:\\s*' + escape(value) +
                        '(\\s*;)?', 'gmi');
                this.cssText =
                        this.cssText.replace(rule, styleName + ': ' + value + ' !' + priority + ';');
            }
        };
        CSSStyleDeclaration.prototype.removeProperty = function(a) {
            return this.removeAttribute(a);
        };
        CSSStyleDeclaration.prototype.getPropertyPriority = function(styleName) {
            var rule = new RegExp(escape(styleName) + '\\s*:\\s*[^\\s]*\\s*!important(\\s*;)?',
                    'gmi');
            return rule.test(this.cssText) ? 'important' : '';
        };
    }

    // The style function
    $.fn.style = function(styleName, value, priority) {
        // DOM node
        var node = this.get(0);
        // Ensure we have a DOM node
        if (typeof node == 'undefined') {
            return this;
        }
        // CSSStyleDeclaration
        var style = this.get(0).style;
        // Getter/Setter
        if (typeof styleName != 'undefined') {
            if (typeof value != 'undefined') {
                // Set style property
                priority = typeof priority != 'undefined' ? priority : '';
                style.setProperty(styleName, value, priority);
                return this;
            } else {
                // Get style property
                return style.getPropertyValue(styleName);
            }
        } else {
            // Get CSSStyleDeclaration
            return style;
        }
    };

//Show-Hide the builder's Elements Menu
    $("#menu_bar").click(function() {

        var f = $("#menu div.main").css("width");

        if ($("div.float-right").css("width") == "140px") {
            $("div.float-right").css("display", "none");
        }

        if (f == '170px') {
            $("#menu div.main").css("width", "40px");
            $("#menu div.second").css("left", "40px");
            $("#mn").css("width", "40px");
            $("#menu div.main *").css("font-size", "0px");
            $("#menu div.main span").css("font-size", "16px");
            $("#menu div.main").css("padding-top", "40px");
            $("#menu_bar").css("left", "0px");
            $("#menu_bar").css("z-index", "1");
            $("#pages *").css("font-size", "0px");
            $("#addPage").css("display", "none");
            $("#main h3:nth-child(3)").css("display", "none");
            $("#scr").css("transform-origin", "right top");
            $("#scr").css("transform", "scale(1)");
        } else {
            $("#menu div.main").css("width", "170px");
            $("#menu div.second").css("left", "170px");
            $("#mn").css("width", "170px");
            $("#menu div.main *").css("font-size", "16px");
            $("#menu div.main span").css("font-size", "16px");
            $("#menu div.main").css("padding-top", "20px");
            $("#menu_bar").css("left", "170px");
            $("#menu_bar").css("z-index", "-2");
            $("#pages *").css("font-size", "16px");
            $("#addPage").css("display", "block");
            $("#main h3:nth-child(3)").css("display", "block");
            $("#scr").css("transform-origin", "right top");
            $("#scr").css("transform", "scale(0.91, 1)");
        }
    });

    $("a#options").click(function() {
        $("div.float-right").toggle();
        $("#menu div.main").css("width", "40px");
        $("#menu div.second").css("left", "40px");
        $("#mn").css("width", "40px");
        $("#menu div.main *").css("font-size", "0px");
        $("#menu div.main span").css("font-size", "16px");
        $("#menu div.main").css("padding-top", "40px");
        $("#menu_bar").css("left", "0px");
    });

})(jQuery);

document.addEventListener("DOMContentLoaded", function(event) {
    $('#savePage').addClass('disabled');
    $('.tempSavecls').addClass('disabled');
});

function deletectext(content_id) {
    $.blockUI();
    $.ajax({
        url: siteUrl + "sites/delete_block_content/",
        type: "POST",
        dataType: "json",
        data: 'content_id=' + content_id + '&site_id=' + siteID,
    }).done(function(response) {
        $.unblockUI();
        if (response.responseCode == 1) {
            $('#editContentModal #load_content').html($(response.responseHTML));

        }

    });
}
function insertctext(el) {

    var updatedata = $(el).parent().find('p').text();
    $('#editContentModal #contentToEdit').redactor('code.set', updatedata);
}