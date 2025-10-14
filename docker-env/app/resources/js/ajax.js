$(function() {

    $("#review_submit").on("click", function() {
        $.ajax({

            url: '/shops/evaluation_create', //LaravelのルーティングにつなぐURL
            type: 'POST', //getかpostを指定
            cache: false, //cacheを使うかどうか
            dataType:'json', //data type scriptなどデータタイプの指定
            
            data:引数名, //Laravelのコントローラへ渡す引数を記述する $request->引数名　などで呼び出せます

                "_token": "{{ csrf_token() }}", //CSRF対策
                shop_id: $('input[name="shop_id"]').val(), // 店舗ID
                user_id: $('input[name="user_id"]').val(), // ユーザーID
                evaluation: $('select[name="evaluation"]').val(), // 評価
                comment: $('textarea[name="comment"]').val(), // コメント
            
            success: function(data){ // 通信が成功したときの処理

                alert("評価を送信しました。");

                var newhtml = `
                    <div>
                        <p>評価: ${data.evaluation} 点</p>
                        <p>投稿者: ${data.user_name}</p>
                        <p>コメント: ${data.comment}</p>
                        <p>投稿日: ${data.created_at}</p>
                    </div>
                `;
                $(".review_list").prepend(newhtml);
                $("textarea[name='comment']").val(""); // コメントを空にする
                $("#evaluation").val(""); // 評価をリセットする
            },

            error: function(){ // 通信が失敗したときの処理（メッセージなど）
                alert("評価送信に失敗しました。もう一度お試しください。");
            }
        
        });
    });
});