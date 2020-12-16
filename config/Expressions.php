<?php

class Exp{

    public $mysql;

    public function __construct(Config $config){

        $this->mysql = $config->conn();

    }

    public function readPosts(){
//        $select = $this->mysql->prepare("SELECT * FROM wp_posts WHERE `post_status` = 'publish' AND `post_type` = 'post' ORDER by id DESC;");
        $select = $this->mysql->prepare("SELECT
                                            p1.*,
                                            wm2.meta_value
                                        FROM
                                            wp_posts p1
                                        LEFT JOIN
                                            wp_postmeta wm1
                                            ON (
                                                wm1.post_id = p1.id
                                                AND wm1.meta_value IS NOT NULL
                                                AND wm1.meta_key = \"_thumbnail_id\"
                                            )
                                        LEFT JOIN
                                            wp_postmeta wm2
                                            ON (
                                                wm1.meta_value = wm2.post_id
                                                AND wm2.meta_key = \"_wp_attached_file\"
                                                AND wm2.meta_value IS NOT NULL
                                            )
                                        WHERE
                                            p1.post_status=\"publish\"
                                            AND p1.post_type=\"post\"
                                        ORDER BY
                                            p1.post_date DESC;");
        $select->execute();
        return $select->fetchAll();
    }

    public function getPostById($id){

      $select = $this->mysql->prepare("SELECT
                                          p1.*,
                                          wm2.meta_value
                                      FROM
                                          wp_posts p1
                                      LEFT JOIN
                                          wp_postmeta wm1
                                          ON (
                                              wm1.post_id = p1.id
                                              AND wm1.meta_value IS NOT NULL
                                              AND wm1.meta_key = \"_thumbnail_id\"
                                          )
                                      LEFT JOIN
                                          wp_postmeta wm2
                                          ON (
                                              wm1.meta_value = wm2.post_id
                                              AND wm2.meta_key = \"_wp_attached_file\"
                                              AND wm2.meta_value IS NOT NULL
                                          )
                                      WHERE
                                          p1.post_status=\"publish\"
                                          AND p1.post_type=\"post\"
                                          AND p1.id IN(".implode(',', $id).")
                                      ORDER BY
                                          p1.post_date DESC;");
      $select->execute();
      return $select->fetchAll();

    }

    public function getPostByCategory($id){

      $select = $this->mysql->prepare("SELECT id, post_title, post_name
        FROM wp_posts
        LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id)
        LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id)
        WHERE wp_term_taxonomy.term_id IN ($id)
        GROUP BY wp_posts.ID");

      $select->execute();
      return $select->fetchAll();

    }

    public function getPostBySlug($slug){

      $select = $this->mysql->prepare("SELECT * FROM `wp_posts` WHERE `post_name` = '$slug' LIMIT 1");

      $select->execute();
      return $select->fetchAll();

    }

    public function getMenu($lang){

      $select = $this->mysql->prepare("SELECT $lang, slug FROM `menu` m JOIN exp e ON m.name = e.id WHERE 1");
      $select->execute();
      return $select->fetchAll();

    }

    public function menuPosts(){

      $select = $this->mysql->prepare("SELECT p.*
  FROM wp_posts AS p
  LEFT JOIN wp_term_relationships AS tr ON tr.object_id = p.ID
  LEFT JOIN wp_term_taxonomy AS tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
 WHERE p.post_type = 'nav_menu_item'
   AND tt.term_id = 5;");

      $select->execute();
      return $select->fetchAll();

    }

    public function getCategoryes(){

      $select = $this->mysql->prepare("SELECT t.term_id AS id,
               t.name    AS post_title,
               t.slug    AS post_url
        FROM   categorias t
               LEFT JOIN wp_term_taxonomy tt
                      ON t.term_id = tt.term_id
        WHERE  tt.taxonomy = 'category'
        ORDER  BY name");

      $select->execute();
      return $select->fetchAll();

    }

    public function newfunc(){

      $select = $this->mysql->prepare();

      $select->execute();
      return $select->fetchAll();

    }

    public function makeImgUrl($url){

      return URL_BASE.'/admin/wp-content/uploads/'.$url;

    }

    public function getLanguages(){

      $select = $this->mysql->prepare("SELECT * FROM `lang` WHERE `slug` LIKE '%lang-%'");

      $select->execute();
      return $select->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getExp($ids, $lg){

      $exps = implode(',', $ids);

      $select = $this->mysql->prepare("SELECT id,$lg as lg FROM `exp` WHERE `id` IN($exps)");

      $select->execute();
      $expressions = array_map('reset', $select->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC));

      $exp = array_combine(
          array_map(function($key){ return 'exp_'.$key; }, array_keys($expressions)),
          $expressions
      );

      return $exp;

    }

}
