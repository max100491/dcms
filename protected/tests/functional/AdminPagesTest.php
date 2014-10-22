<?php
/**
* 
*/
class AdminPagesTest extends WebTestCase
{
    
    // public function testNotAutorized()
    // {
    //     $this->open('/admin/pages/admin');
    //     $this->assertTextPresent('Войти');

    //     $this->open('/admin/pages/create');
    //     $this->assertTextPresent('Войти');

    //     $this->open('/admin/pages/update/1');
    //     $this->assertTextPresent('Войти');

    //     $this->open('/admin/pages/delete/1');
    //     $this->assertTextPresent('Войти');
    // }

    // public function testOkAutorized()
    // {
    //     $this->open('/admin/pages/admin');
    //     if($this->isTextPresent('Все страницы'))
    //         $this->clickAndWait('link=Выход');

    //     $this->assertElementPresent('name=LoginForm[username]');
    //         $this->type('name=LoginForm[username]', 'admin');
    //     $this->assertElementPresent('name=LoginForm[password]');
    //         $this->type('name=LoginForm[password]', 'admin');
    //     $this->clickAndWait("//input[@value='Войти']");
    //     $this->assertTextPresent('Все страницы');


    //     $this->open('/admin/pages/create');
    //     if($this->isTextPresent('Создать новую запись')){
    //         $this->clickAndWait('link=Выход');
    //         $this->open('/admin/pages/create');
    //     }
    //     $this->assertElementPresent('name=LoginForm[username]');
    //         $this->type('name=LoginForm[username]', 'admin');
    //     $this->assertElementPresent('name=LoginForm[password]');
    //         $this->type('name=LoginForm[password]', 'admin');
    //     $this->clickAndWait("//input[@value='Войти']");
    //     $this->assertTextPresent('Создать новую запись');

    //     $this->open('/admin/pages/update/id/3');
    //     if($this->isTextPresent('Обновить запись')){
    //         $this->clickAndWait('link=Выход');
    //         $this->open('/admin/pages/update/id/3');
    //     }
    //     $this->assertElementPresent('name=LoginForm[username]');
    //         $this->type('name=LoginForm[username]', 'admin');
    //     $this->assertElementPresent('name=LoginForm[password]');
    //         $this->type('name=LoginForm[password]', 'admin');
    //     $this->clickAndWait("//input[@value='Войти']");
    //     $this->assertTextPresent('Обновить запись');
    // }

    public function loginPages($url, $txt)
    {
        $this->open($url);
        if($this->isTextPresent($txt)){
            $this->clickAndWait('link=Выход');
            $this->open($url);
        }
        $this->assertElementPresent('name=LoginForm[username]');
            $this->type('name=LoginForm[username]', 'admin');
        $this->assertElementPresent('name=LoginForm[password]');
            $this->type('name=LoginForm[password]', 'admin');
        $this->clickAndWait("//input[@value='Войти']");
        $this->assertTextPresent($txt);
    }

    public function testDeletePage()
    {
        $this->loginPages('/admin/pages/admin', 'Все страницы');
        $this->assertElementPresent("class=delete");
        $this->clickAndWait("class=delete");
    }
}

?>