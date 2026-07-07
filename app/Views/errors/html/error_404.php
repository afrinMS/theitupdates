<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = '404 - Page Not Found';
include APPPATH . 'Views/User/headtag.php';
?>

<body>
    <div class="main-page-wrapper">
        <?php include APPPATH . 'Views/User/header.php'; ?>

        <section class="itb-404-section">
            <div class="itb-404-bg-shape"></div>
            <div class="container">
                <div class="itb-404-card white-bg text-center">
                    <p class="itb-404-badge">Oops! You hit a missing page</p>
                    <h1 class="itb-404-title">404</h1>
                    <h2 class="itb-404-subtitle"><?= esc(lang('Errors.pageNotFound')) ?></h2>
                    <p class="itb-404-message">
                        <?php if (ENVIRONMENT !== 'production') : ?>
                            <?= nl2br(esc($message)) ?>
                        <?php else : ?>
                            <?= esc(lang('Errors.sorryCannotFind')) ?>
                        <?php endif; ?>
                    </p>

                    <div class="itb-404-actions">
                        <a href="<?= base_url('/') ?>" class="theme-button-one hvr-bounce-to-right">Back to Home</a>
                        <a href="<?= base_url('contact') ?>" class="itb-404-link">Contact Support</a>
                    </div>
                </div>
            </div>
        </section>

        <?php include APPPATH . 'Views/User/footer.php'; ?>
    </div>

    <style>
        .itb-404-section {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #eef8f3 0%, #f4fbf7 55%, #ffffff 100%);
            padding: 90px 0;
        }

        .itb-404-bg-shape {
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(20, 186, 118, 0.18) 0%, rgba(20, 186, 118, 0) 70%);
            right: -120px;
            top: -120px;
            pointer-events: none;
        }

        .itb-404-card {
            max-width: 760px;
            margin: 0 auto;
            border-radius: 12px;
            padding: 48px 30px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
            border: 1px solid #e6f4ed;
            position: relative;
            z-index: 2;
        }

        .itb-404-badge {
            display: inline-block;
            margin: 0 0 18px;
            padding: 7px 14px;
            border-radius: 999px;
            background: #e6f8ef;
            color: #0f9f63;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .itb-404-title {
            margin: 0;
            font-size: 92px;
            line-height: 1;
            font-weight: 700;
            color: #cca541;
        }

        .itb-404-subtitle {
            margin: 10px 0 14px;
            font-size: 30px;
            color: #1e2b2f;
            font-weight: 600;
        }

        .itb-404-message {
            margin: 0 auto;
            max-width: 560px;
            color: #5f6f66;
            font-size: 16px;
            line-height: 1.8;
        }

        .itb-404-actions {
            margin-top: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .itb-404-link {
            color: #1f7d56;
            font-weight: 600;
            text-decoration: underline;
        }

        .itb-404-link:hover,
        .itb-404-link:focus {
            color: #cca541;
        }

        @media (max-width: 767px) {
            .itb-404-section {
                padding: 60px 0;
            }

            .itb-404-card {
                padding: 38px 20px;
            }

            .itb-404-title {
                font-size: 66px;
            }

            .itb-404-subtitle {
                font-size: 24px;
            }
        }
    </style>

    <?php include APPPATH . 'Views/User/footerscripts.php'; ?>
</body>

</html>
