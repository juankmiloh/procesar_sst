<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
?>


<body class="background_images">

    <div class="container-fluid">

        <div class="dashboard-wrapper">
            
            <!-- MIGA DE PAN -->
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">
                            Toggle navigation</span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <?php
                            echo Html::a('<i class="icon-graphic_eq"></i>' . Yii::t("app", "INICIO"), array("evento/index"));
                            ?>
                        </li>
                        <li class="active">
                            <a><i class="icon-graphic_eq"></i> <?= Yii::t("app", "PROGRAMACION") ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Barra Azul -->
            <div class="top-bar clearfix">
            </div>

        <div class="row gutter">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-light">
                                    <div class="panel-heading">
                                            <h4><?= Yii::t('app', "PROGRAMACION") ?></h4>
                                    </div>


                                    <div class="row gutter">
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                <?= 
                                                     Html::a('<img src="../img/sorteo.png" class="img-responsive" alt="SORTEOS"><h1>' . Yii::t("app", "SORTEO") ."</h1>", 
                                                             array("programacion/sorteo"), array("class" => "block-60 green-bg", "style" =>"display: flex;"));
                                                ?>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                <?= 
                                                     Html::a('<img src="../img/enuentros.png" class="img-responsive" alt="SORTEOS"><h1>' . Yii::t("app", "ENCUENTROS") ."</h1>", 
                                                             array("programacion/encuentros"), array("class" => "block-60 red-bg", "style" =>"display: flex;"));
                                                ?>
                                            </div>
                                    </div>

                            </div>
                    </div>
            </div>
            
        </div>
    </div>
</body>