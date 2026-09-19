$(function(){

    const acknowledged = new Set(POLICY_DATA.acknowledgedIds);
    const total = POLICY_DATA.totalPolicies;
    const items = $('.policy-btn');

    let current = 0;
    let canAcknowledge = false;

    function updateProgress(){
        const done = acknowledged.size;
        const percent = total > 0 ? (done/total)*100 : 0;
        $('#progressFill').css('width', percent+'%');
        $('#progressText').text(done+' / '+total+' acknowledged');
    }

    function enableAck(){
        if(canAcknowledge) return;
        canAcknowledge = true;
        $('#ackCheck').prop('disabled',false);
        $('#ackBtn').text('Acknowledge & Continue');
    }

    function loadPolicy(index){
        const btn = items.eq(index);
        const pid = parseInt(btn.data('id'));

        items.removeClass('active');
        btn.addClass('active');
        current = index;

        $('#policyTitle').text(btn.data('title'));

        const contentDiv = $('#policyContent');
        contentDiv.html(btn.data('content')).scrollTop(0);

        if(acknowledged.has(pid)){
            $('#actionArea').hide();
            $('#alreadyAckMsg').show();
            canAcknowledge = true;
        }else{
            $('#actionArea').show();
            $('#alreadyAckMsg').hide();
            canAcknowledge = false;

            $('#ackCheck').prop({checked:false,disabled:true});
            $('#ackBtn').prop('disabled',true).text('Read full policy to continue').show();
            $('#successBadge').hide();

            setTimeout(function(){
                if(contentDiv[0].scrollHeight <= contentDiv[0].clientHeight + 10){
                    enableAck();
                }
            }, 100);
        }
    }

    items.on('click',function(){
        loadPolicy($(this).data('index'));
    });

    $('#policyContent').on('scroll',function(){
        if(canAcknowledge) return;
        if(this.scrollTop + this.clientHeight >= this.scrollHeight - 5){
            enableAck();
        }
    });

    $('#ackCheck').on('change',function(){
        $('#ackBtn').prop('disabled',!this.checked);
    });

    $('#ackBtn').on('click',function(){

        if(!canAcknowledge || !$('#ackCheck').is(':checked')){
            alert('Please read the policy entirely and check the box to acknowledge.');
            return;
        }

        const btn = items.eq(current);
        const pid = parseInt(btn.data('id'));

        $('#ackBtn').prop('disabled',true).text('Saving...');
        $('#ackCheck').prop('disabled',true);

        $.post(POLICY_DATA.acknowledgeUrl, {policy_id:pid}, function(res){

            if(res.status === 'success' || res.status === 'already_acknowledged'){
                acknowledged.add(pid);
                updateProgress();

                btn.addClass('acknowledged');
                btn.find('span:first').text('✓ ');
                $('#successBadge').show();
                $('#ackBtn').hide();

                setTimeout(function(){

                    let next = items.filter(function(){
                        return !acknowledged.has(parseInt($(this).data('id')));
                    }).first();

                    if(next.length > 0){
                        loadPolicy(next.data('index'));
                    } else {
                        window.location.href = POLICY_DATA.redirectUrl;
                    }

                },600);
            }

        }, 'json');
    });

    let firstPending = items.filter(function(){
        return !acknowledged.has(parseInt($(this).data('id')));
    }).first();

    firstPending.length
        ? loadPolicy(firstPending.data('index'))
        : $('#policyTitle').text("All Policies Acknowledged!");

    if (!firstPending.length && total > 0) {
        if(viewpage != 1){
        window.location.href = POLICY_DATA.redirectUrl;
        }
    }

    updateProgress();
});