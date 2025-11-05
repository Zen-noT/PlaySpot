$(function() {

    $("#review_submit").on("click", function() {
        $.ajax({

            url: '/shops/evaluation_create', 
            type: 'POST', 
            cache: false, 
            dataType:'json', 
            
            data:{ //引数名 $request->引数名　
                shop_id: $('input[name="shop_id"]').val(), 
                user_id: $('input[name="user_id"]').val(), 
                evaluation: $('select[name="evaluation"]').val(), 
                comment: $('textarea[name="comment"]').val(), 
            },

            success: function(data){ 

                alert("評価を送信しました。");

                var newhtml = `
                <div class="card" style="width: 70%;">
                    <div  class="container mt-3 py-3">
                        <div class="review_list">
                            <div class="card-body">
                                <div class="card mt-3 p-3">
                                    <p>評価: ${data.evaluation} 点</p>
                                    <p>投稿者: ${data.user_name}</p>
                                    <p>コメント: ${data.comment}</p>
                                    <p>投稿日: ${data.created_at}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                $(".review_list").prepend(newhtml);

                $("textarea[name='comment']").val(""); // コメントを空にする
                $("#evaluation").val("1"); // 評価をリセット
            },

            error: function(){ 
                alert("評価送信に失敗しました。もう一度お試しください。");
            }
        
        });
    });
});