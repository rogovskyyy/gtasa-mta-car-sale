<?php
namespace Application\Index;

    require 'vendor/autoload.php';
    use Application\Database\Database;

    class Index extends Database
    {
        private $name;
        private $course;
        private $price;

        public function ReturnResult(string $name, string $course, string $price)
        {
            $search_data = [
                'name' => $name,
                'course' => $course,
                'price' => $price
            ];
            $data = [];
            $sql = 'SELECT id, model, price, course, headlights, wheels, mk1, mk2, mk3, rh1, taxi FROM notices WHERE id >= 0';
            $where = '';

            foreach ($search_data as $key => $value) {
                if(!$value) continue; // skip empty values

                if ($key === 'name') {
                    $data[':name'] ='%'.$value.'%';
                    $where .= 'AND model LIKE :name';
                }
                if ($key === 'course') {
                    $data[':course'] = $value;
                    $where .= ' AND course <= :course ';
                }
                if ($key === 'price') {
                    $data[':price'] = $value;
                    $where .= ' AND price <= :price ';
                }
            }
            

            $syntax = $sql.$where;

            $sth = $this->Db->prepare($syntax);
            $sth->execute($data);
            $result = $sth->fetchAll();
            foreach($result as $values)
            {
                print "<div class='ad'>";
                    $data = [
                        'id' => $values['id'],
                    ];
                    $syntax = 'SELECT images_href FROM images WHERE images_id = :id ORDER BY images_href ASC LIMIT 1';
                    $sth = $this->Db->prepare($syntax);
                    $sth->execute($data);
                    $result = $sth->fetch();
                    print "<img class='ad-img' src='".$result['images_href']."'>
                        <div class='ad-container'>
                            <p class='ad-title'>".$values['model']."</p>
                            <div class='ad-info'>
                                <div class='ad-info-box course'>Przebieg: ".$values['course']."</div>
                                <div class='ad-info-box lights'>Światła: ".$values['headlights']."</div>
                                <div class='ad-info-box wheels'>Felgi: ".$values['wheels']."</div>";
                                if($values['mk1'] == 'true')
                                {
                                    print "<div class='ad-info-box MK1'>MK1</div>";
                                }
                                if($values['mk2'] == 'true')
                                {
                                    print "<div class='ad-info-box MK2'>MK2</div>";
                                }
                                if($values['mk3'] == 'true')
                                {
                                    print "<div class='ad-info-box MK3'>MK3</div>";
                                }
                                if($values['rh1'] == 'true')
                                {
                                    print "<div class='ad-info-box RH1'>RH1</div>";
                                }
                                if($values['taxi'] == 'true')
                                {
                                    print "<div class='ad-info-box Taxi'>Taxi</div>";
                                }
                           print "</div>
                        </div>
                        <div class='ad-container'>
                            <p class='ad-price'>".$values['price']."</p>
                            <p class='ad-buy'>Kontakt</p>
                        </div>
                    </div>";
            }
        }
    }