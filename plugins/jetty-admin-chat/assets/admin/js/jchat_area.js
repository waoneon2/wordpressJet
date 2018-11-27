(function($) {
    "use strict";
    var $chatWindow = $('#jchat_messages');
    var chatClient;
    var generalChannel;
    var otherChannel;
    var username;
    var dateVal;
    var titleDateVal;
    var $urlImgProfile;
    var $tokenlifecycle;
    var AccessManager;
    var bol_call_func = 0;
    var saveHistoryChannel = [];
    var differentUser = false;
    var isPageReload = false;
    var isWindowPerformanceFine = true;
    var all_channel_visited = [];
    var isDeleteChannel = false;
    var isAddingPublicChannel = false;

    if (window.performance) {
        isWindowPerformanceFine = true;
        if (performance.navigation.type == 1) {
            isPageReload = true;
        } else {
            isPageReload = false;
        }
    }

    $(window).unload(function(){
      localStorage.removeItem('jchat_token_twilio');
      localStorage.removeItem('jchat_client_username');
      localStorage.removeItem('jchat_client_photo');
      // localStorage.removeItem('jchat_last_room_visited');
      // localStorage.removeItem('jchat_save_history_channel');
    });

    window.onresize = function(event) {
        $("#jchat_first_content").dialog({height:'auto'});
    };

    function jchatRemoveValueOnArray(array, element) {
        const index = array.indexOf(element);
        
        if (index !== -1) {
            array.splice(index, 1);
        }
    }

    function formatDate(date) {
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }


    function jchatPrint(infoMessage, asHtml) {
        var $msg = $('<div class="jchat_info">');
        if (asHtml) {
            $msg.html(infoMessage);
        } else {
            $msg.text(infoMessage);
        }
        $chatWindow.append($msg);
    }

    function jchatPrintMessage(fromUser, message, chatDatetime, imgProfile) {
        var onDate = new Date(chatDatetime);
        titleDateVal = formatDate(onDate);
        var $user = $('<span class="jchat_username">').text(fromUser + '');
        var $datetime = $('<span class="jchat_datetime" title="' + titleDateVal + '">').text(chatDatetime);
        var $userImg = $('<span class="jchat_imgprofile">').html('<img src="' + imgProfile + '"/>');

        var $message = $('<span class="jchat_message">').text(message);
        var $container = $('<div class="jchat_message-container">');

        if (fromUser === username) {
            $container.addClass('jchat_me');
        }
        $container.append($user).append($datetime).append($message);
        $chatWindow.append($container);
        $chatWindow.scrollTop($chatWindow[0].scrollHeight);
    }

    function processPage(page) {
        page.items.forEach(message => {
            dateVal = new Date(message.timestamp);
            jchatPrintMessage(message.author, message.body, dateVal.toLocaleString(), $urlImgProfile);
            bol_call_func = 1;
        });
        if (page.hasNextPage) {
            page.nextPage().then(processPage);
        } else {
            // console.log("all messages read!");
        }
    }

    // function getAllMemberOnCurrentChannel(channel_id) {
    //     $.ajax({
    //         url: jchat_ajax_action.ajax_url,
    //         type: 'post',
    //         data: {
    //             action: 'jchat_g_m_c',
    //             channel: channel_id
    //         },
    //         beforeSend: function() {
    //             $('div.jchat_member_on_room').html('Fetching users on the current channel...');
    //         },
    //         success: function(curdata) {
    //             var $qHtml = '';
    //             var curParse = JSON.parse(curdata);

    //             for (var j = 0; j < curParse['content'].length; j++) {
    //                 $qHtml += '<span class="jchat_user_name" data-user="'+curParse['content'][j].midentity+'">';
    //                 $qHtml += curParse['content'][j].midentity;

    //                 if (curParse['user_role'] === 'administrator' || curParse['user_role'] === 'network_admin' || curParse['user_role'] === 'site_admin') {
    //                     $qHtml += '<span class="jchat_delete_user" data-mid="' + curParse['content'][j].mid + '">';
    //                     $qHtml += 'X';
    //                     $qHtml += '</span>';
    //                 }
    //                 $qHtml += '</span>';
    //             }
    //             $('div.jchat_member_on_room').html('');
    //             $('div.jchat_member_on_room').prepend($qHtml);
    //             jchatDeleteUserOnChannel();

    //         }
    //     });
    // }

    function searchAutoComplete(au, gc) {
        $("#jbucket_user_email_search").autocomplete({
            source: au,
            delay: 500,
            minLength: 3,
            select: function(event, ui) {
                var userEmailInvite = ui.item.value;
                var channelSid = gc.sid;

                gc.invite(userEmailInvite).then(function() {
                  // console.log('Your friend has been invited!');
                });

                $.ajax({
                    url: jchat_ajax_action.ajax_url,
                    type: 'post',
                    data: {
                        action: 'jchat_add_member_on_channel',
                        key_jchat_: 'jchat_get_all_member',
                        jchat_curr_channel: channelSid,
                        jchat_user_email: userEmailInvite
                    },
                    beforeSend: function() {
                        $('span.notif_progress').html('Adding user on current room...');
                        $("#jchat_first_content").dialog({height:'auto'});
                    },
                    success: function(curdata) {
                        var curParse = JSON.parse(curdata);
                        $('#jbucket_user_email_search').val('');
                        $('#jbucket_user_email_search').attr("placeholder", "Success !!");

                        $('span.notif_progress').html('User added.').delay(800).fadeOut('slow', function() {
                            $('span.notif_progress').html('');
                            $('span.notif_progress').show();
                            $("#jchat_first_content").dialog({height:'auto'});
                        });

                        var members = gc.getMembers();

                        members.then(function(currentMembers) {
                            jchatGetMembers(currentMembers);
                        });

                        getMoC(gc);

                        $("#jchat_first_content").dialog({height:'auto'});
                    }
                });
            },
            response: function(event, ui) {
                if (!ui.content.length) {
                    var noResult = {
                        value: "",
                        label: "No results found"
                    };
                    ui.content.push(noResult);
                }
            }
        });
    }

    function getMoC(gc) {
        $.ajax({
            url: jchat_ajax_action.ajax_url,
            type: 'post',
            data: {
                action: 'jchat_get_member_on_channel',
                channel: gc.sid
            },
            beforeSend: function() {

            },
            success: function(curdata) {
                var k_i = JSON.parse(curdata);

                var availableUsers_gm = [];
                for (var i = 0; i < k_i['content'].length; i++) {
                    availableUsers_gm.push(k_i['content'][i]);
                }

                searchAutoComplete(availableUsers_gm, gc);
            }
        });
    }

    function addUniqueClass(cid){
        setTimeout(function(){
            if($('div[class*="jchat_u_channel_"]').length > 0){
                $('div.jac-jetty-dialog').removeClass(function (index, css) {
                    return (css.match (/\bjchat_u_channel_\S+/g) || []).join(' ');
                }).addClass('jchat_u_channel_'+cid);
            } else {
                $('.jac-jetty-dialog').addClass('jchat_u_channel_'+cid);
            }
        }, 1500);
    }

    function createOrJoinGeneralChannel() {
        if((localStorage.getItem('jchat_last_room_visited') === null || differentUser === true) || (localStorage.getItem('jchat_last_room_visited') === null && differentUser === true)){
            jchatPrint('Attempting to join "jettygeneralchatroom" chat channel...');
            var promise = chatClient.getChannelByUniqueName('jettygeneralchatroom');
            promise.then(function(channel) {
                generalChannel = channel;
                generalChannel.getMessages(30, 0, 'forward').then(processPage).catch(function(e) {
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                });
                var members = generalChannel.getMembers();

                members.then(function(currentMembers) {
                    jchatGetMembers(currentMembers);
                });

                getMoC(generalChannel);

                setupChannel(generalChannel);

                addUniqueClass(generalChannel.sid);

            }).catch(function(e) {
                // If it doesn't exist, let's create it
                chatClient.createChannel({
                    uniqueName: 'jettygeneralchatroom',
                    friendlyName: 'General Chat Channel for Jetty'
                }).then(function(channel) {
                    generalChannel = channel;
                    var members = generalChannel.getMembers();

                    members.then(function(currentMembers) {
                        jchatGetMembers(currentMembers);
                    });

                    getMoC(generalChannel);

                    setupChannel(generalChannel);

                    addUniqueClass(generalChannel.sid);
                });
            });
        } else {

            var jSaveHistoryChannel_one = localStorage.getItem('jchat_save_history_channel');
            var jSHC_one = jSaveHistoryChannel_one.replace("[","").replace("]","").split(',');

            var jLastRoomVisited = localStorage.getItem('jchat_last_room_visited');

            if(jLastRoomVisited !== null){
                var jCUniqueName = jLastRoomVisited;
            } else {
                var jCUniqueName = jSHC_one[jSHC_one.length-1];
            }

            jchatPrint('Attempting to join "'+jCUniqueName+'" chat channel...');
            var promiseTwo = chatClient.getChannelByUniqueName(jCUniqueName);
            promiseTwo.then(function(channel) {
                generalChannel = channel;
                generalChannel.getMessages(30, 0, 'forward').then(processPage).catch(function(e) {
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                });
                var members = generalChannel.getMembers();

                members.then(function(currentMembers) {
                    jchatGetMembers(currentMembers);
                });

                getMoC(generalChannel);

                setupChannel(generalChannel);

                addUniqueClass(generalChannel.sid);

            }).catch(function(e) {
                // If it doesn't exist
                $('div#jchat_messages').empty().html('<h3 class="room_not_available">Channel not available or already deleted.</h3>');
                $('textarea#chat-input').prop('disabled', true);
                $('div.jchat_member_on_room').empty();
                $("#jchat_first_content").dialog({height:'auto'});
            });
        }
    }

    function setupChannel(gc_c) {
        gc_c.join().then(function(channel) {
            jchatPrint('Joined channel as ' +
                '<span class="jchat_me">' + username + '</span>.', true);

            gc_c.on('messageAdded', function(message) {
            if($('.jchat_u_channel_'+gc_c.sid).length > 0){
                if(username !== message.author ){
                    $("i#jchat_notif_msg").attr('class', 'fas fa-comments').css({
                        "color": "red",
                    });
                }
            
                dateVal = new Date(message.timestamp);
                jchatPrintMessage(message.author, message.body, dateVal.toLocaleString(), $urlImgProfile);
            }
            
            });

            typingProgress(gc_c);
        });
    }

    function createRoomFromButton(currentUser) {
        // On Button
        $('button#jchat_click_create_room').click(function(event) {
            event.preventDefault();
            var lk = $('button[id*="jchat_channel_"]');

            var valInput = $('input#create_room').val();

            if (valInput !== '') {
                var lowerCase = valInput.toLowerCase();
                var strU = lowerCase.replace(/\s/g, '');

                if($('#jchat_type_room')[0].checked){
                    var attrChat = {
                        uniqueName: strU,
                        friendlyName: valInput,
                        isPrivate: true
                    };
                } else {
                    var attrChat = {
                        uniqueName: strU,
                        friendlyName: valInput,
                        isPrivate: false
                    };
                    isAddingPublicChannel = true;
                }

                currentUser.createChannel(attrChat).then(function(channel) {
                    var generalChannels = channel;

                    $.ajax({
			            url: jchat_ajax_action.ajax_url,
			            type: 'post',
			            data: {
			                action: 'jchat_handle_retrieve_all_users_chat',
			                jchat_key_rt: 'jchat_rau'
			            },
			            beforeSend: function() {

			            },
			            success: function(response) {
			            	var r_a_u = JSON.parse(response);
			            	if(r_a_u['error'] === false && isAddingPublicChannel === true){
			            		var return_data = r_a_u['content'];
			            		for (var i = 0; i < return_data.length; i++) {
			            			generalChannels.invite(return_data[i]).then(function() {
					                  // console.log('Your friend has been invited!');
					                });
			            		}
			            	}
			            	isAddingPublicChannel = false;
			            }
			        });
                    generalChannels.join().then(function(channel){
                        $.ajax({
                            url: jchat_ajax_action.ajax_url,
                            type: 'post',
                            data: {
                                action: 'jchat_get_all_channel',
                                key_jchat_gac: 'jchat_get_l_c_'
                            },
                            beforeSend: function() {
                                $('span.notif_progress').html('Creating room...');
                                // Disable
                                $('input#create_room').prop('disabled', true);
                                $('button#jchat_click_create_room').prop('disabled', true)
                                $('input#jbucket_user_email_search').prop('disabled', true);

                                for (var i = 0; i < lk.length; i++) {
                                    lk[i].disabled = true;
                                }
                                $("#jchat_first_content").dialog({height:'auto'});
                            },
                            success: function(curdata) {
                                $('input#create_room').prop('disabled', false);
                                $('button#jchat_click_create_room').prop('disabled', false);
                                $('input#jbucket_user_email_search').prop('disabled', false);
                                $('input#create_room').val('');
                                $('#jchat_type_room')[0].checked = false;

                                for (var j = 0; j < lk.length; j++) {
                                    lk[j].disabled = false;
                                }

                                var curParse = JSON.parse(curdata);
                                $("div#jchat_on_button_room").html('');
                                var $bHtml = '';
                                if (curParse['error'] === false || curParse['error'] === 'false') {
                                    var contentData = curParse['content'];
                                    for (var i = 0; i < contentData.length; i++) {
                                        if(contentData[i].hidden_room === 'no'){
                                            $bHtml += '<button class="jchat_roomls jchat_room_' + i + ' hidden_'+contentData[i].hidden_room+'" id="jchat_channel_' + i + '" data-sid=' + contentData[i].sid + ' data-accountsid=' + contentData[i].accountSid + ' data-servicesid=' + contentData[i].serviceSid + ' data-uniquename=' + contentData[i].uniqueName + '>';
                                                $bHtml += contentData[i].friendlyName;
                                            $bHtml += '</button>';
                                            if (curParse['user_role'] === 'administrator' || curParse['user_role'] === 'network_admin' || curParse['user_role'] === 'site_admin') {
                                                $bHtml += '<button class="jchat_delete_room" data-service="'+contentData[i].serviceSid+'" data-channel="'+contentData[i].sid+'" data-channelname="'+contentData[i].friendlyName+'">';
                                                $bHtml += 'X';
                                                $bHtml += '</button>';
                                            }
                                        }
                                    }

                                    $('span.notif_progress').html('Room created.').delay(800).fadeOut('slow', function() {
                                        $('span.notif_progress').html('');
                                        $('span.notif_progress').show();
                                        $("#jchat_first_content").dialog({height:'auto'});
                                    });

                                    $("div#jchat_on_button_room").prepend($bHtml);

                                    jchatMoveToOtherRoom();
                                    jchatDeleteChannel();

                                    var jLastRoomVisited = localStorage.getItem('jchat_last_room_visited');

                                    if(isWindowPerformanceFine === true && isPageReload === true && saveHistoryChannel.length === 0 && all_channel_visited.length === 0){
                                        setTimeout(function(){
                                            if($('button[data-uniquename="'+jLastRoomVisited+'"]').length > 0){
                                                $('button[data-uniquename="'+jLastRoomVisited+'"]').addClass('user_visited').addClass("jchat_button_active").prop('disabled', true);
                                            }
                                        }, 1500);
                                    } else {
                                        setTimeout(function(){
                                            saveHistoryChannel.forEach( function(element, index) {
                                                if($('button[data-uniquename="'+element+'"]').length > 0){
                                                    $('button[data-uniquename="'+element+'"]').addClass('user_visited');
                                                }
                                            });

                                            var getLastElement = saveHistoryChannel[saveHistoryChannel.length-1];
                                            if($('button[data-uniquename="'+getLastElement+'"]').length > 0){
                                                $('button[data-uniquename="'+getLastElement+'"]').addClass("jchat_button_active").prop('disabled', true);
                                            }

                                            all_channel_visited.forEach( function(element, index) {
                                                if($('button[data-uniquename="'+element+'"]').length > 0){
                                                    $('button[data-uniquename="'+element+'"]').addClass('user_visited');
                                                }
                                            });
                                        }, 1500);
                                    }
                                }
                                $("#jchat_first_content").dialog({height:'auto'});
                            }
                        });
                    }, function(e){
                        console.log(e);
                    });
                }, function(e){
                    console.log(e);
                });
            }
        });
    }

    function jchatDeleteUserOnChannel() {
        $('span.jchat_delete_user').click(function(event) {
            event.preventDefault();
            var g_mid = $(this).data('mid');
            var v_user = $(this).parent();

            var result = confirm('Do you want to remove the user email : '+v_user.data("user")+' from channel : '+generalChannel.friendlyName+' ?');

            if (result) {
                $.ajax({
                    url: jchat_ajax_action.ajax_url,
                    type: 'post',
                    data: {
                        action: 'jchat_delete_user_on_channel_handle',
                        mid: g_mid,
                        cid: generalChannel.sid
                    },
                    beforeSend: function() {
                        $('span.notif_progress').html('Deleting User...');
                        $(v_user).css("pointer-events", "none");
                        $(v_user).addClass("disable_on_delete");
                        $("#jchat_first_content").dialog({height:'auto'});
                    },
                    success: function(curdata) {
                        var curParse = JSON.parse(curdata);
                        var members = generalChannel.getMembers();

                        members.then(function(currentMembers) {
                            jchatGetMembers(currentMembers);
                        });

                        getMoC(generalChannel);

                        $('span.notif_progress').html('User deleted.').delay(800).fadeOut('slow', function() {
                            $('span.notif_progress').html('');
                            $('span.notif_progress').show();
                            $("#jchat_first_content").dialog({height:'auto'});
                        });

                        $("#jchat_first_content").dialog({height:'auto'});
                    }
                });
            } 
        });
    }

    function jchatResetChatContainer(channelname){
        if(channelname === ''){
            $('div#jchat_messages').empty().html('<h3 class="room_not_available">Your active channel is not available for now.</h3>');
        } else {
            $('div#jchat_messages').empty().html('<h3 class="room_not_available">Channel : '+channelname+', not available for now.</h3>');
        }
        
        $('textarea#chat-input').prop('disabled', true);
        $('div.jchat_member_on_room').empty();
        $("#jchat_first_content").dialog({height:'auto'});
    }

    function jchatDeleteChannel(){
        $('button.jchat_delete_room').click(function(event) {
            event.preventDefault();
            var g_service = $(this).data('service');
            var g_channel = $(this).data('channel')
            var g_room    = $(this).data('channelname');

            var getRoomActive = $(this).prev();
            var getAreaButtonRoom = $(this).parent();
            var getAllVisitedRoom = getAreaButtonRoom.find('button.user_visited');
            var bolGetClass = getRoomActive.hasClass('jchat_button_active');

            if(bolGetClass || (getAllVisitedRoom.length === 1 && getRoomActive.hasClass('user_visited'))){
                var result_current = confirm('Do you want to delete the currently active channel ?');
                if(result_current){
                    $.ajax({
                        url: jchat_ajax_action.ajax_url,
                        type: 'post',
                        data: {
                            action: 'jchat_delete_channel',
                            channel: g_channel,
                            channelname: g_room,
                            service: g_service
                        },
                        beforeSend: function() {
                            $('span.notif_progress').html('Deleting Room...');
                            $('button.jchat_delete_room').prop('disabled', true);
                            var c_l = $('button[data-sid="'+g_channel+'"]');
                            $(c_l).addClass('disable_on_delete');
                            $('textarea#chat-input').prop('disabled', true);
                            $("#jchat_first_content").dialog({height:'auto'});
                            isDeleteChannel = true;
                        },
                        success: function(curdata) {
                            $('span.notif_progress').html('Room deleted.').delay(800).fadeOut('slow', function() {
                                $('span.notif_progress').html('');
                                $('span.notif_progress').show();
                                $("#jchat_first_content").dialog({height:'auto'});
                            });

                            $('button.jchat_delete_room').prop('disabled', false);

                            jchatSetAllChannel();
                            jchatDeleteChannel();
                            jchatResetChatContainer(g_room);
                            $("#jchat_first_content").dialog({height:'auto'});
                        }
                    }); 
                }
            } else {
                var result = confirm('Do you want to delete room: '+g_room+' ?');
                if(result){
                    $.ajax({
                        url: jchat_ajax_action.ajax_url,
                        type: 'post',
                        data: {
                            action: 'jchat_delete_channel',
                            channel: g_channel,
                            channelname: g_room,
                            service: g_service
                        },
                        beforeSend: function() {
                            $('span.notif_progress').html('Deleting Room...');
                            $('button.jchat_delete_room').prop('disabled', true);
                            var c_l = $('button[data-sid="'+g_channel+'"]');
                            $(c_l).addClass('disable_on_delete');
                            $("#jchat_first_content").dialog({height:'auto'});
                            isDeleteChannel = true;
                        },
                        success: function(curdata) {
                            $('span.notif_progress').html('Room deleted.').delay(800).fadeOut('slow', function() {
                                $('span.notif_progress').html('');
                                $('span.notif_progress').show();
                                $("#jchat_first_content").dialog({height:'auto'});
                            });

                            $('button.jchat_delete_room').prop('disabled', false);

                            jchatSetAllChannel();
                            jchatDeleteChannel();
                            $("#jchat_first_content").dialog({height:'auto'});
                        }
                    });
                }
            }
        });
    }

    function userAddOnChannel(currentUser) {
        // Start ajax get all user
        var availableUsers_uac = [];
        $.ajax({
            url: jchat_ajax_action.ajax_url,
            type: 'post',
            data: {
                action: 'jchat_get_all_user_handle',
                jchat_key: 'jchat_get_all_user'
            },
            beforeSend: function() {

            },
            success: function(response) {
                var allUser = JSON.parse(response);
                if (allUser['error'] === false || allUser['error'] === 'false') {
                    var userContent = allUser['content']
                    for (var i = 0; i < userContent.length; i++) {
                        availableUsers_uac.push(userContent[i].user_email);
                    }

                    searchAutoComplete(availableUsers_uac, generalChannel);
                }
            }
        });
        // ---
    }

    function jchatSetAllChannel() {
        $.ajax({
            url: jchat_ajax_action.ajax_url,
            type: 'post',
            data: {
                action: 'jchat_get_all_channel',
                key_jchat_gac: 'jchat_get_l_c_'
            },
            beforeSend: function() {

            },
            success: function(curdata) {
                var curParse = JSON.parse(curdata);
                var $bHtml = '';
                if (curParse['error'] === false || curParse['error'] === 'false') {
                    $("div#jchat_on_button_room").html('');
                    var contentData = curParse['content'];
                    for (var i = 0; i < contentData.length; i++) {

                        if(contentData[i].hidden_room === 'no'){
                            $bHtml += '<button class="jchat_roomls jchat_room_' + i + ' hidden_'+contentData[i].hidden_room+'" id="jchat_channel_' + i + '" data-sid=' + contentData[i].sid + ' data-accountsid=' + contentData[i].accountSid + ' data-servicesid=' + contentData[i].serviceSid + ' data-uniquename=' + contentData[i].uniqueName + '>';
                                $bHtml += contentData[i].friendlyName;
                            $bHtml += '</button>';
                            if (curParse['user_role'] === 'administrator' || curParse['user_role'] === 'network_admin' || curParse['user_role'] === 'site_admin') {
                                $bHtml += '<button class="jchat_delete_room" data-service="'+contentData[i].serviceSid+'" data-channel="'+contentData[i].sid+'" data-channelname="'+contentData[i].friendlyName+'">';
                                $bHtml += 'X';
                                $bHtml += '</button>';
                            }
                        }
                    }

                    $("div#jchat_on_button_room").prepend($bHtml);

                    jchatMoveToOtherRoom();
                    jchatDeleteChannel();
                    jchatOnScrollDown();

                    if(localStorage.getItem('jchat_save_history_channel') !== null && differentUser !== true){
                        var jSaveHistoryChannel = localStorage.getItem('jchat_save_history_channel');
                        var jLastRoomVisited = localStorage.getItem('jchat_last_room_visited');
                        var jSHC = jSaveHistoryChannel.replace("[","").replace("]","").split(',');
                        setTimeout(function(){
                            if(isDeleteChannel === true && all_channel_visited.length > 0){
                                all_channel_visited.forEach( function(element, index) {
                                    if($('button[data-uniquename="'+element+'"]').length > 0){
                                        $('button[data-uniquename="'+element+'"]').addClass('user_visited');
                                    }
                                });
                                isDeleteChannel = false;
                            } else {
                                var getLastElement = jSHC[jSHC.length-1];
                                if(jLastRoomVisited !== null){
                                    if($('button[data-uniquename="'+jLastRoomVisited+'"]').length > 0){
                                        $('button[data-uniquename="'+jLastRoomVisited+'"]').addClass('user_visited').addClass("jchat_button_active").prop('disabled', true);
                                    }

                                    if(all_channel_visited.length > 0){
                                        all_channel_visited.forEach( function(element, index) {
                                            if($('button[data-uniquename="'+element+'"]').length > 0){
                                                $('button[data-uniquename="'+element+'"]').addClass('user_visited');
                                            }
                                        });
                                    }
                                } else {
                                    if($('button[data-uniquename="'+getLastElement+'"]').length > 0){
                                        $('button[data-uniquename="'+getLastElement+'"]').addClass('user_visited').addClass("jchat_button_active").prop('disabled', true);
                                    }

                                    if(all_channel_visited.length > 0){
                                        all_channel_visited.forEach( function(element, index) {
                                            if($('button[data-uniquename="'+element+'"]').length > 0){
                                                $('button[data-uniquename="'+element+'"]').addClass('user_visited');
                                            }
                                        });
                                    }
                                }
                            } 
                        }, 1500);
                    } else {
                        setTimeout(function(){
                            if($('button[data-uniquename="jettygeneralchatroom"]').length > 0){
                                $('button[data-uniquename="jettygeneralchatroom"]').addClass('user_visited');
                            }

                            if(saveHistoryChannel.length > 0){
                                if($.inArray('jettygeneralchatroom', saveHistoryChannel) === -1){
                                    saveHistoryChannel.push('jettygeneralchatroom');
                                } else {
                                    saveHistoryChannel.forEach( function(element, index) {
                                        if($('button[data-uniquename="'+element+'"]').length > 0){
                                            $('button[data-uniquename="'+element+'"]').addClass('user_visited');
                                        }
                                    });

                                    var getLastElement = saveHistoryChannel[saveHistoryChannel.length-1];
                                    if($('button[data-uniquename="'+getLastElement+'"]').length > 0){
                                        $('button[data-uniquename="'+getLastElement+'"]').addClass("jchat_button_active").prop('disabled', true);
                                    } else {
                                        jchatResetChatContainer('');
                                        jchatRemoveValueOnArray(saveHistoryChannel, getLastElement);
                                    }
                                }
                            } else {
                                saveHistoryChannel.push('jettygeneralchatroom');
                            }
                        }, 1500);
                    }
                    $("#jchat_first_content").dialog({height:'auto'});
                }
            }
        });

        return false;
    }

    function jchatOnScrollDown(){
        $('div#jchat_messages').bind('scroll', jchatScroll);
    }

    function jchatScroll(e)
    {

        var elem = $(e.currentTarget);
        if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight())
        {
            $("i#jchat_notif_msg").attr('class', 'far fa-comments').css({
                "color": "inherit",
            });
        }

    }

    jchatSetAllChannel();

    function refreshMessageAdded(gc_a){
        gc_a.on('messageAdded', function(message) {
            if($('.jchat_u_channel_'+gc_a.sid).length > 0){
                if(username !== message.author ){
                        $("i#jchat_notif_msg").attr('class', 'fas fa-comments').css({
                        "color": "red",
                    });
                }
            
                dateVal = new Date(message.timestamp);
                jchatPrintMessage(message.author, message.body, dateVal.toLocaleString(), $urlImgProfile);
            }
        });
    }

    function typingProgress(gc_b){

        gc_b.on('typingStarted', function(member) {
            if($('.jchat_u_channel_'+gc_b.sid).length > 0){
                $('.user_is_typing').html(member.state.identity+ ' is typing ...');
            }
        });

        gc_b.on('typingEnded', function(member) {
            if($('.jchat_u_channel_'+gc_b.sid).length > 0){
                $('.user_is_typing').html('');
            }
            
        });
        
    }

    function jchatGetMembers(allmember){
        var d_html = '';
        for (var i = 0; i < allmember.length; i++) {
            var member = allmember[i].state;
            d_html += '<span class="jchat_user_name" data-user="'+member.identity+'">';
                d_html += member.identity;

                d_html += '<span class="jchat_delete_user" data-mid="' + member.sid + '">';
                d_html += 'X';
                d_html += '</span>';

            d_html += '</span>';
        }

        $('div.jchat_member_on_room').html('');
        $('div.jchat_member_on_room').prepend(d_html);

        jchatDeleteUserOnChannel();
        $("#jchat_first_content").dialog({height:'auto'});
    }

    function jchatMoveToOtherRoom() {
        $('button[id*="jchat_channel_"]').click(function(event) {
            var $kl = chatClient.getSubscribedChannels();
            $('textarea#chat-input').prop('disabled', false);

            event.preventDefault();
            $('button[id*="jchat_channel_"]').removeClass("jchat_button_active").prop('disabled', false);
            $(this).addClass("jchat_button_active").prop('disabled', true);
            $('#chat-input').val('');
            var io = $(this);

            var promise = chatClient.getChannelByUniqueName(io.data('uniquename'));
            promise.then(function(channel) {
                $chatWindow.html('');

                generalChannel = channel;
                otherChannel = channel;

                generalChannel.join().then(function(channel) {
                    jchatPrint('Joined to the "' + io.data('uniquename') + '" chat channel...');

                    getMoC(generalChannel);

                    generalChannel.getMessages(30, 0, 'forward').then(processPage).catch(function(e) {
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    });

                    if(io.hasClass('user_visited') === false){
                        refreshMessageAdded(generalChannel);
                        io.addClass('user_visited');
                    }

                    if(saveHistoryChannel.length > 0){
                        if($.inArray(generalChannel.uniqueName, saveHistoryChannel) === -1){
                            saveHistoryChannel.push(generalChannel.uniqueName);
                        }
                    } else {
                        saveHistoryChannel.push(generalChannel.uniqueName);
                    }

                    localStorage.setItem('jchat_last_room_visited', generalChannel.uniqueName);

                    localStorage.setItem('jchat_save_history_channel', saveHistoryChannel);

                    var all_el = $('#jchat_on_button_room').find('button.user_visited');

                    for (var i = 0; i < all_el.length; i++) {
                        all_channel_visited.push($(all_el[i]).data('uniquename'));
                    }
              
                    var members = generalChannel.getMembers();

                    members.then(function(currentMembers) {
                        jchatGetMembers(currentMembers);
                    });

                    addUniqueClass(otherChannel.sid);

                    typingProgress(generalChannel);
                });
            }).catch(function(e) {
                $chatWindow.html('');
                jchatPrint(e);
                console.log(e);
            });
        });
    }

    function initData(){
        $.ajax({
            url: jchat_ajax_action.ajax_url,
            type: 'post',
            data: {
                action: 'jchat_handle_ajax_req',
                device: 'browser'
            },
            beforeSend: function() {

            },
            success: function(response) {
                var jUsername;
                var jPhotoUser;
                var jC;

                if (typeof(Storage) !== "undefined") {
                    if(localStorage.getItem('jchat_token_twilio') === null && localStorage.getItem('jchat_client_username') === null && localStorage.getItem('jchat_client_photo') === null){
                        localStorage.setItem('jchat_token_twilio', response.token);
                        localStorage.setItem('jchat_client_username', response.identity);
                        localStorage.setItem('jchat_client_photo', response.userAvatarUrl);
                        differentUser = false;
                    } else {
                        if(localStorage.getItem('jchat_client_username') !== response.identity){
                            localStorage.setItem('jchat_token_twilio', response.token);
                            localStorage.setItem('jchat_client_username', response.identity);
                            localStorage.setItem('jchat_client_photo', response.userAvatarUrl);
                            differentUser = true;
                        }
                    }

                    jC  = localStorage.getItem('jchat_token_twilio');
                    jUsername = localStorage.getItem('jchat_client_username');
                    jPhotoUser = localStorage.getItem('jchat_client_photo');

                    username = jUsername;
                    $urlImgProfile = jPhotoUser;
                    jchatPrint('You have been assigned a username of: ' +
                        '<span class="jchat_me">' + username + '</span>', true);

                    chatClient = new Twilio.Chat.Client(jC);
                    AccessManager = new Twilio.AccessManager(jC);

                    createRoomFromButton(chatClient);

                    chatClient.getSubscribedChannels().then(createOrJoinGeneralChannel);
                    userAddOnChannel(chatClient);

                    chatClient.on('channelInvited', function(channel) {
                      	jchatSetAllChannel();
                    });

                    chatClient.on('channelRemoved', function(channel) {
                    	var getChannelUniqueName = channel.uniqueName;
                    	var getChannelFriendlyName = channel.friendlyName;
                    	var isRoomActive = $('button[data-uniquename="'+getChannelUniqueName+'"]').hasClass('jchat_button_active');

                      	jchatSetAllChannel();

                      	if(isRoomActive === true){
                      		jchatResetChatContainer(getChannelFriendlyName);
                      	}
                    });
                } else {
                    username = response.identity;
                    $urlImgProfile = response.userAvatarUrl;
                    jchatPrint('You have been assigned a username of: ' + '<span class="jchat_me">' + username + '</span>', true);

                    chatClient = new Twilio.Chat.Client(response.token);
                    AccessManager = new Twilio.AccessManager(response.token);

                    createRoomFromButton(chatClient);

                    chatClient.getSubscribedChannels().then(createOrJoinGeneralChannel);
                    userAddOnChannel(chatClient);

                    chatClient.on('channelInvited', function(channel) {
                      	jchatSetAllChannel();
                    });

                    chatClient.on('channelRemoved', function(channel) {
                      	var getChannelUniqueName = channel.uniqueName;
                    	var getChannelFriendlyName = channel.friendlyName;
                    	var isRoomActive = $('button[data-uniquename="'+getChannelUniqueName+'"]').hasClass('jchat_button_active');
                    	
                      	jchatSetAllChannel();

                      	if(isRoomActive === true){
                      		jchatResetChatContainer(getChannelFriendlyName);
                      	}
                    });
                }
            }
        });
    }

    initData();

    var $input = $('#chat-input');
    $input.on('keydown', function(e) {
        if (e.keyCode == 13) {
            if ($.trim($input.val()) === '') {
                $input.val('');
            } else {
                if(otherChannel === undefined){
                    generalChannel.sendMessage($input.val()).then(function(s) {
                        $input.val('');
                    });
                } else {
                    otherChannel.sendMessage($input.val()).then(function(s) {
                        $input.val('');
                    });
                }
                
            }
        } else {
            if(otherChannel === undefined){
                generalChannel.typing();
            } else {
                otherChannel.typing();
            }
            
        }
    });
}(jQuery));