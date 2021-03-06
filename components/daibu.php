<!-- 校园代步模块 -->
        <div class="index-title">
            <a href="">校园代步</a>
            <hr class="hr1">
            <hr class="hr2">
        </div>

        <div class="components row" id="box3">
            <!-- 模板 -->
            <div class="card col" v-for="item in source">
                <a href="./index.php">
                    <div class="card-image"><img src="{{item.path}}"></div>
                    <div class="card-content item-price">￥{{item.price}}</div>
                    <div class="card-content item-name">
                        <p>{{item.name}}</p>
                    </div>
                    <div class="card-content item-location">
                        <p>{{item.school}}</p>
                        <p>{{item.date}}</p>
                    </div>
                </a>
            </div>
        </div>