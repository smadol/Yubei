$(function () {
    //定时查询订单状态
    var checkOrderStatus = function () {
        clearTimeout(qi);
        $.ajax({
            url: 'order.php',
            success: function (ret) {
                if (ret.code == 1) {
                    var data = ret.data;
                    if (data.status !== 'inprogress' && data.status != 'expired') {
                        clearTimeout(ci);

                        $(".qrcode .paid").removeClass("hidden");
                        if (data.returnurl != '') {
                            $(".warning").addClass("success").html(addon.jumptips).removeClass("hidden");
                            setTimeout(function () {
                                location.href = data.returnurl;
                            }, 2000);
                        } else {
                            $(".warning").addClass("success").html(addon.successtips).removeClass("hidden");
                        }
                    } else if (data.status == 'expired') {
                        $(".qrcode .expired").removeClass("hidden");
                    } else {
                        qi = setTimeout(function () {
                            checkOrderStatus();
                        }, 3000);
                    }
                } else {
                    qi = setTimeout(function () {
                        checkOrderStatus();
                    }, 3000);
                }
            },
            error: function () {
                qi = setTimeout(function () {
                    checkOrderStatus();
                }, 3000);
            }
        })

    };

    checkOrderStatus();

});