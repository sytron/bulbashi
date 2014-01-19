<?php

class ReportController extends Controller
{

    public $layout = '//layouts/column2';


	public function actionIndex()
	{

		$this->redirect(array('report/admin'));
	}

    public function actionAdmin()
    {
        $this->render('admin');
    }


    public function actionCreate() {
        {
            switch( $_GET['type']) {
                case 'doneworks' :
                    if (isset($_POST['daterange'])) {
                        $range = explode(' - ', $_POST['daterange']);

                        $cr = new CDbCriteria();
                        $cr->addCondition('status = 3');
                        if( isset($_POST['client'] ) && $_POST['client']!= 0 ) {
                            $cr->addCondition('client_id = '.$_POST['client']);
                        }
                        $cr->addBetweenCondition('time_created', strtotime($range[0]), strtotime($range[1]));
                        $orders = Order::model()->findAll($cr);
                        $allItems = array();
                        foreach( $orders as $ord ) {
                            foreach( $ord->items as $it ) {
                                if( stripos($it['name'],'Работа') !== false ) {
                                    if( !empty($_POST['mask']) ) {
                                        if( stripos($it['name'],$_POST['mask']) !== false ) {
                                            $allItems[] = $it;
                                        }
                                    } else {
                                        $allItems[] = $it;
                                    }

                                }


                            }
                        }

                        $out = array();
                        $summary = array('count' => 0, 'money' => 0);
                        foreach( $allItems as &$i ) {
                            $ar = Item::model()->findByPk($i['id']);
                            if( isset($_POST['category'] ) && $_POST['category']!= 0 ) {
                                if( $ar->category_id != $_POST['category'] )
                                    continue;
                            }
                            $i['category_id'] = $ar->category_id;
                            $i['category_name'] = $ar->category->name;
                            if( !isset($out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]) ) {
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['name'] = $i['name'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['price'] = $i['price'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['count'] = $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            } else {
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['count'] += $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            }
                        }


                        $this->renderPartial('tpl/'.$_GET['type'], array(
                            'a' => array(
                                'start' => $range[0],
                                'end' => $range[1],
                                'out' => $out,
                                'summary' => $summary
                            )
                        ));
                        Yii::app()->end();
                        //if ($model->save())
                        //    $this->redirect(array('admin'));
                    }

                    $this->render('create', array(
                        'form' => '_doneworks',
                    ));
                    break;
                case 'doneworks_month' :
                    if (isset($_POST['daterange'])) {
                        $range = explode(' - ', $_POST['daterange']);

                        $monthsArray = array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');

                        $ranges = array();
                        $tmp = explode('.',$range[0]);
                        $monthBegin = $tmp[1];
                        $tmp = explode('.',$range[1]);
                        $monthEnd = $tmp[1];
                        $first = 1;
                        $curMonth = $monthBegin;
                        do {
                            $temp = array(
                                'monthNum' => $monthBegin,
                                'monthName' => $monthsArray[$monthBegin-1],
                                'begin' => (($curMonth == $monthBegin) ? $range[0] : '01.'.$monthBegin.$tmp[2] )
                            );
                            //if( $curMonth == $monthBegin && $curMonth+1 <= $monthEnd )
                                //$temp['end'] =>
                            //$ranges[]
                        } while( $curMonth != $monthEnd );

                        $cr = new CDbCriteria();
                        $cr->addCondition('status = 3');
                        if( isset($_POST['client'] ) && $_POST['client']!= 0 ) {
                            $cr->addCondition('client_id = '.$_POST['client']);
                        }
                        $cr->addBetweenCondition('time_created', strtotime($range[0]), strtotime($range[1]));
                        $orders = Order::model()->findAll($cr);
                        $allItems = array();
                        foreach( $orders as $ord ) {
                            foreach( $ord->items as $it ) {
                                if( stripos($it['name'],'Работа') !== false ) {
                                    if( !empty($_POST['mask']) ) {
                                        if( stripos($it['name'],$_POST['mask']) !== false ) {
                                            $allItems[] = $it;
                                        }
                                    } else {
                                        $allItems[] = $it;
                                    }

                                }


                            }
                        }

                        $out = array();
                        $summary = array('count' => 0, 'money' => 0);
                        foreach( $allItems as &$i ) {
                            $ar = Item::model()->findByPk($i['id']);
                            if( isset($_POST['category'] ) && $_POST['category']!= 0 ) {
                                if( $ar->category_id != $_POST['category'] )
                                    continue;
                            }
                            $i['category_id'] = $ar->category_id;
                            $i['category_name'] = $ar->category->name;
                            if( !isset($out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]) ) {
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['name'] = $i['name'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['price'] = $i['price'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['count'] = $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            } else {
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['count'] += $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            }
                        }


                        $this->renderPartial('tpl/'.$_GET['type'], array(
                                'a' => array(
                                    'start' => $range[0],
                                    'end' => $range[1],
                                    'out' => $out,
                                    'summary' => $summary
                                )
                            ));
                        Yii::app()->end();
                        //if ($model->save())
                        //    $this->redirect(array('admin'));
                    }

                    $this->render('create', array(
                        'form' => '_doneworks',
                    ));
                    break;
                case 'rashod' :
                    if (isset($_POST['daterange'])) {
                        $range = explode(' - ', $_POST['daterange']);

                        $cr = new CDbCriteria();
                        $cr->addCondition('status = 3');
                        if( isset($_POST['client'] ) && $_POST['client']!= 0 ) {
                            $cr->addCondition('client_id = '.$_POST['client']);
                        }
                        $cr->addBetweenCondition('time_created', strtotime($range[0]), strtotime($range[1]));
                        $orders = Order::model()->findAll($cr);
                        $allItems = array();
                        foreach( $orders as $ord ) {
                            foreach( $ord->items as $it ) {
                                if( stripos($it['name'],'Работа') === false ) {
                                    if( !empty($_POST['mask']) ) {
                                        if( stripos($it['name'],$_POST['mask']) !== false ) {
                                            $allItems[] = $it;
                                        }
                                    } else {
                                        $allItems[] = $it;
                                    }

                                }


                            }
                        }

                        $out = array();
                        $summary = array('count' => 0, 'money' => 0);
                        foreach( $allItems as &$i ) {
                            $ar = Item::model()->findByPk($i['id']);
                            if( isset($_POST['category'] ) && $_POST['category']!= 0 ) {
                                if( $ar->category_id != $_POST['category'] )
                                    continue;
                            }
                            $i['category_id'] = $ar->category_id;
                            $i['category_name'] = $ar->category->name;
                            if( !isset($out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]) ) {
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['name'] = $i['name'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['price'] = $i['price'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['count'] = $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            } else {
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['count'] += $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            }
                        }


                        $this->renderPartial('tpl/'.$_GET['type'], array(
                                'a' => array(
                                    'start' => $range[0],
                                    'end' => $range[1],
                                    'out' => $out,
                                    'summary' => $summary
                                )
                            ));
                        Yii::app()->end();
                        //if ($model->save())
                        //    $this->redirect(array('admin'));
                    }

                    $this->render('create', array(
                        'form' => '_'.$_GET['type'],
                    ));
                    break;
                case 'perechen' :
                    if (isset($_POST['daterange'])) {
                        $range = explode(' - ', $_POST['daterange']);

                        $cr = new CDbCriteria();
                        $cr->addCondition('status = 3');
                        if( isset($_POST['client'] ) && $_POST['client']!= 0 ) {
                            $cr->addCondition('client_id = '.$_POST['client']);
                        }
                        $cr->addBetweenCondition('time_created', strtotime($range[0]), strtotime($range[1]));
                        $orders = Order::model()->findAll($cr);
                        $allItems = array();
                        $out = array();
                        $summary = array('count' => 0, 'money' => 0);

                        foreach( $orders as $ord ) {
                            foreach( $ord->items as $it ) {
                                $it['order_id'] = $ord->id;
                                $it['order_date'] = date('m.d.Y',$ord->time_created);
                                if( !empty($_POST['mask']) ) {
                                    if( stripos($it['name'],$_POST['mask']) !== false ) {
                                        $allItems[] = $it;
                                    }
                                } else {
                                    $allItems[] = $it;
                                }
                            }
                        }


                        foreach( $allItems as &$i ) {
                            $ar = Item::model()->findByPk($i['id']);
                            if( isset($_POST['category'] ) && $_POST['category']!= 0 ) {
                                if( $ar->category_id != $_POST['category'] )
                                    continue;
                            }
                            $i['category_id'] = $ar->category_id;
                            $i['category_name'] = $ar->category->name;
                            if( !isset($out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]) ) {
                                $out['№'.$i['order_id'].' от '.$i['order_date']][md5($ar->category_id.$ar->name.$i['price'])]['name'] = $i['name'];
                                $out['№'.$i['order_id'].' от '.$i['order_date']][md5($ar->category_id.$ar->name.$i['price'])]['price'] = $i['price'];
                                $out['№'.$i['order_id'].' от '.$i['order_date']][md5($ar->category_id.$ar->name.$i['price'])]['count'] = $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            } else {
                                $out['№'.$i['order_id'].' от '.$i['order_date']][md5($ar->category_id.$ar->name.$i['price'])]['count'] += $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            }
                        }


                        $this->renderPartial('tpl/'.$_GET['type'], array(
                                'a' => array(
                                    'start' => $range[0],
                                    'end' => $range[1],
                                    'out' => $out,
                                    'summary' => $summary
                                )
                            ));
                        Yii::app()->end();
                        //if ($model->save())
                        //    $this->redirect(array('admin'));
                    }

                    $this->render('create', array(
                        'form' => '_'.$_GET['type'],
                    ));
                    break;
                case 'pribil_zapchasti' :
                    if (isset($_POST['daterange'])) {
                        $range = explode(' - ', $_POST['daterange']);

                        $cr = new CDbCriteria();
                        $cr->addCondition('status = 3');
                        if( isset($_POST['client'] ) && $_POST['client']!= 0 ) {
                            $cr->addCondition('client_id = '.$_POST['client']);
                        }
                        $cr->addBetweenCondition('time_created', strtotime($range[0]), strtotime($range[1]));
                        $orders = Order::model()->findAll($cr);
                        $allItems = array();
                        foreach( $orders as $ord ) {
                            foreach( $ord->items as $it ) {
                                if( stripos($it['name'],'Работа') === false ) {
                                    if( !empty($_POST['mask']) ) {
                                        if( stripos($it['name'],$_POST['mask']) !== false ) {
                                            $allItems[] = $it;
                                        }
                                    } else {
                                        $allItems[] = $it;
                                    }

                                }


                            }
                        }

                        $out = array();
                        $summary = array('count' => 0, 'money' => 0);
                        foreach( $allItems as &$i ) {
                            $ar = Item::model()->findByPk($i['id']);
                            if( isset($_POST['category'] ) && $_POST['category']!= 0 ) {
                                if( $ar->category_id != $_POST['category'] )
                                    continue;
                            }
                            $i['category_id'] = $ar->category_id;
                            $i['category_name'] = $ar->category->name;
                            if( !isset($out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]) ) {
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['name'] = $i['name'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['price'] = $i['price'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['priceZ'] = $ar['price_z'];
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['count'] = $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            } else {
                                $out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]['count'] += $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            }
                        }


                        $this->renderPartial('tpl/'.$_GET['type'], array(
                                'a' => array(
                                    'start' => $range[0],
                                    'end' => $range[1],
                                    'out' => $out,
                                    'summary' => $summary
                                )
                            ));
                        Yii::app()->end();
                        //if ($model->save())
                        //    $this->redirect(array('admin'));
                    }

                    $this->render('create', array(
                        'form' => '_'.$_GET['type'],
                    ));
                    break;
                case 'teams' :
                    if (isset($_POST['daterange'])) {
                        $range = explode(' - ', $_POST['daterange']);

                        $cr = new CDbCriteria();
                        $cr->addCondition('status = 3');
                        if( isset($_POST['client'] ) && $_POST['client']!= 0 ) {
                            $cr->addCondition('client_id = '.$_POST['client']);
                        }
                        $cr->addBetweenCondition('time_created', strtotime($range[0]), strtotime($range[1]));
                        $orders = Order::model()->findAll($cr);
                        $allItems = array();
                        foreach( $orders as $ord ) {
                            foreach( $ord->items as $it ) {
                                $f = 0;
                                switch($_POST['type']) {
                                    case '1' : if( stripos($it['name'],'Работа') === false ) {
                                                $f = 1;
                                            }
                                            break;
                                    case '2' : if( stripos($it['name'],'Работа') !== false ) {
                                                $f = 1;
                                            }
                                            break;
                                    default:break;
                                }
                                if( $f == 1 )
                                    continue;
                                if( !empty($_POST['mask']) ) {
                                    if( stripos($it['name'],$_POST['mask']) !== false ) {
                                        $it['team_name'] = $ord->team->name;
                                        $allItems[] = $it;
                                    }
                                } else {
                                    $it['team_name'] = $ord->team->name;
                                    $allItems[] = $it;
                                }

                            }
                        }

                        $out = array();
                        $summary = array('count' => 0, 'money' => 0);
                        foreach( $allItems as &$i ) {
                            $ar = Item::model()->findByPk($i['id']);
                            if( isset($_POST['category'] ) && $_POST['category']!= 0 ) {
                                if( $ar->category_id != $_POST['category'] )
                                    continue;
                            }
                            $i['category_id'] = $ar->category_id;
                            $i['category_name'] = $ar->category->name;
                            if( !isset($out[$ar->category->name][md5($ar->category_id.$ar->name.$i['price'])]) ) {
                                $out[$i['team_name']][md5($ar->category_id.$ar->name.$i['price'])]['name'] = $i['name'];
                                $out[$i['team_name']][md5($ar->category_id.$ar->name.$i['price'])]['price'] = $i['price'];
                                $out[$i['team_name']][md5($ar->category_id.$ar->name.$i['price'])]['count'] = $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            } else {
                                $out[$i['team_name']][md5($ar->category_id.$ar->name.$i['price'])]['count'] += $i['count'];
                                $summary['count'] += $i['count'];
                                $summary['money'] += $i['price']*$i['count'];
                            }
                        }


                        $this->renderPartial('tpl/'.$_GET['type'], array(
                                'a' => array(
                                    'start' => $range[0],
                                    'end' => $range[1],
                                    'out' => $out,
                                    'summary' => $summary
                                )
                            ));
                        Yii::app()->end();
                        //if ($model->save())
                        //    $this->redirect(array('admin'));
                    }

                    $this->render('create', array(
                        'form' => '_'.$_GET['type'],
                    ));
                    break;
            }


        }

    }

}