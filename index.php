<?php include_once "./api/base.php"; ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Images Change</title>
    <style>
        .banner {
            width: 100%;
            height: 100vh;
            text-align: center;
            overflow: hidden;
            position: relative;
        }

        .banner .slider {
            position: absolute;
            width: 200px;
            height: 200px;
            top: 10%;
            left: calc(50% - 100px);
            transform-style: preserve-3d;
            transform: perspective(1000px);
            animation: autoRun 20s Linear infinite;
            z-index: 2;
        }

        @keyframes autoRun {
            from {
                transform: perspective(1000px) rotateX(-16deg) rotateY(0deg);
            }

            to {
                transform: perspective(1000px) rotateX(-16deg) rotateY(360deg);
            }
        }

        .banner .slider .item {
            position: absolute;
            cursor: pointer;
            inset: 0 0 0 0;
            transform:
                rotateY(calc((var(--position) - 1) * (360 / var(--quantity)) * 1deg)) translateZ(550px);
            transition: transform 0.3s ease;
        }

        .banner .slider .item:hover {
            transform:
                rotateY(calc((var(--position) - 1) * (360 / var(--quantity)) * 1deg)) translateZ(550px) translateY(-50px);
        }

        .banner .slider .item img {
            width: 100%;
            height: 100%;
            transition: transform 0.2s ease;
        }

        .banner .slider .item.front img {
            transform: scale(1.5);
        }

        .banner .content {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: min(1400px, 100vw);
            height: max-content;
            padding-bottom: 100px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: end;
            z-index: 1;
        }

        .banner .content h1 {
            margin: auto;
            font-family: 'ICA Rubrik';
            font-size: 15em;
            line-height: 1em;
            color: #25283B;
            position: relative;
        }

        .banner .content h1::after {
            position: absolute;
            inset: 0 0 0 0;
            content: attr(data-content);
            z-index: 2;
            -webkit-text-stroke: 2px #d2d2d2;
        }

        .banner .content .outhor {
            font-family: 'Poppins';
            text-align: right;
            max-width: 200px;
        }

        .banner .content h2 {
            font-size: 3em;
        }

        .banner .content .model {
            background-image: url("images/img.jpg");
            width: 100%;
            height: 80vh;
            position: absolute;
            bottom: 0;
            left: 0;
            background-size: auto 130%;
            background-repeat: no-repeat;
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="banner">
        <div class="slider" style="--quantity:10">
            <?php
            $data = $Pictures->all();
            foreach ($data as $key => $value) {
            ?>
                <div class="item" style="--position:<?= $value['order_id'] ?>">
                    <a href="./backend/edit_item.php?id=<?= $value['id'] ?>"><img src="./images/<?= $value['item'] ?>" alt=""><button style="display: none;"></button></a>
                    <input type="hidden" name="order_id" value=<?= $value['order_id'] ?>>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="content">
            <h1 data-content="ONLY 10 PIC">
                ONLY 10 PIC
            </h1>
            <div class="author">
                <h2>For Interviews</h2>
                <p><b>Junior Desijgn</b></p>
                <p>Lorem ipsum dolor sit amet consectetur.</p>
            </div>
            <div style="display:flex;padding-right: 80px;;">
                <a href="./backend/del_item.php" style="text-decoration: none;color:red;font-size:25px;font-weight: 600; z-index:10;">
                    <div><i class="fa-solid fa-minus"></i>刪除</div>
                </a>
                <a href="./backend/add_item.php" style="text-decoration: none;color:blue;font-size:25px;font-weight: 600;">
                    <div class="model"></div>
                    <div><i class="fa-solid fa-plus"></i>新增</div>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.banner .slider .item');
            const quantity = items.length;

            function updateItems(position) {
                items.forEach((item, index) => {
                    item.classList.remove('front');
                    if (index === (position - 1) % quantity) {
                        item.classList.add('front');
                    }
                });
            }

            let position = 1; // 初始化位置
            updateItems(position);

            // 模擬更新位置的邏輯
            setInterval(() => {
                position = (position % quantity) + 1;
                updateItems(position);
            }, 2000); // 每 2 秒更新一次位置
        });
    </script>
</body>

</html>