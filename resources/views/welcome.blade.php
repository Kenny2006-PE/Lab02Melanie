<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melanie Nieves Chavez</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f8f8;
            font-family: 'Cormorant Garamond', serif;
            overflow: hidden;
        }

        .container {
            position: relative;
            z-index: 2;
        }

        h1 {
            font-weight: 300;
            font-size: 4.5rem;
            color: #333;
            white-space: nowrap;
            position: relative;
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .letter {
            display: inline-block;
            opacity: 0;
            transform: translateY(40px) rotateY(90deg);
            animation: appearAndRotate 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        @keyframes appearAndRotate {
            to {
                opacity: 1;
                transform: translateY(0) rotateY(0);
            }
        }

        .particle {
            position: absolute;
            background: #c3a6b1;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
            animation: float 3s ease-in-out infinite, fadeIn 0.3s ease forwards;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
            }
            50% {
                transform: translateY(-20px) translateX(10px);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 0.6;
            }
        }

        .cursor-follower {
            position: fixed;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: rgba(195, 166, 177, 0.3);
            pointer-events: none;
            z-index: 1000;
            transform: translate(-50%, -50%);
            transition: width 0.2s, height 0.2s;
            mix-blend-mode: multiply;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.05;
            z-index: 0;
        }

        .circle1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #b393d3, #8d91c7);
            top: -150px;
            right: -150px;
            animation: move 15s infinite alternate ease-in-out;
        }

        .circle2 {
            width: 250px;
            height: 250px;
            background: linear-gradient(45deg, #c3a6b1, #b393d3);
            bottom: -100px;
            left: -100px;
            animation: move 12s infinite alternate-reverse ease-in-out;
        }

        @keyframes move {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(50px, 50px);
            }
        }

        .highlight {
            position: absolute;
            width: 100%;
            height: 5px;
            bottom: -10px;
            left: 0;
            background: linear-gradient(90deg, transparent, #c3a6b1, transparent);
            transform: scaleX(0);
            transform-origin: left;
            animation: highlightAnim 1.5s ease-out forwards 1.5s;
        }

        @keyframes highlightAnim {
            to {
                transform: scaleX(1);
            }
        }

        .shimmer {
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.4) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            animation: shimmer 3s infinite;
            animation-delay: 2s;
            pointer-events: none;
        }

        @keyframes shimmer {
            to {
                left: 150%;
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
    </div>

    <div class="cursor-follower"></div>

    <div class="container">
        <h1 id="name">
            <div class="shimmer"></div>
            <div class="highlight"></div>
        </h1>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameElement = document.getElementById('name');
            const name = "Melanie Nieves Chavez";
            const follower = document.querySelector('.cursor-follower');
            const container = document.querySelector('.container');
            const background = document.querySelector('.background');

            // Create animated letters
            for(let i = 0; i < name.length; i++) {
                const letterSpan = document.createElement('span');
                letterSpan.className = 'letter';
                letterSpan.textContent = name[i];
                letterSpan.style.animationDelay = `${i * 0.08}s`;
                nameElement.appendChild(letterSpan);
            }

            // Cursor follower
            document.addEventListener('mousemove', function(e) {
                follower.style.left = `${e.clientX}px`;
                follower.style.top = `${e.clientY}px`;

                // Create occasional particles
                if (Math.random() > 0.95) {
                    createParticle(e.clientX, e.clientY);
                }
            });

            // Mouseover effect on name
            nameElement.addEventListener('mouseover', function() {
                follower.style.width = '40px';
                follower.style.height = '40px';
            });

            nameElement.addEventListener('mouseout', function() {
                follower.style.width = '20px';
                follower.style.height = '20px';
            });

            // Create particles function
            function createParticle(x, y) {
                const particle = document.createElement('div');
                particle.className = 'particle';

                const size = Math.random() * 8 + 3;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                // Calculate random position near mouse
                const angle = Math.random() * Math.PI * 2;
                const distance = Math.random() * 40 + 10;
                const particleX = x + Math.cos(angle) * distance;
                const particleY = y + Math.sin(angle) * distance;

                particle.style.left = `${particleX}px`;
                particle.style.top = `${particleY}px`;

                // Random animation duration
                particle.style.animationDuration = `${Math.random() * 2 + 2}s`;

                background.appendChild(particle);

                // Remove particle after animation
                setTimeout(() => {
                    particle.remove();
                }, 3000);
            }

            // Add random particles occasionally
            setInterval(() => {
                const x = Math.random() * window.innerWidth;
                const y = Math.random() * window.innerHeight;
                createParticle(x, y);
            }, 500);

            // Add click effect
            document.addEventListener('click', function(e) {
                // Create several particles in a burst pattern
                for (let i = 0; i < 10; i++) {
                    setTimeout(() => {
                        createParticle(e.clientX, e.clientY);
                    }, i * 50);
                }
            });
        });
    </script>
</body>
</html>
