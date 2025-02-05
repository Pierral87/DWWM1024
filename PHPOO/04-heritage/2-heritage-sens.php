<?php 

class A {
    public function testA()
    {
        return "testA";
    }
}

class B extends A 
{
    public function testB() 
    {
        return "testB";
    }
}

class C extends B 
{
    public function testC()
    {
        return "testC";
    }
}

$c = new C;
var_dump(get_class_methods($c));

/* 

    Si C hérite de B   
        que B hérite de A 
            alors C hérite de A même s'il n'y a pas de lien direct entre les deux 

            -- C'est ce qu'on appelle la transitivité -- 

    Autres détails sur l'héritage : 

        - Non reflexif : class D extends D // Erreur, une classe ne peut pas hériter d'elle même 
        - Non symétrique : class F extends E // F hérite de E, mais E n'hérite pas de F 
        - Sans cycle : class Y extends X 
                        class X extends Y // Erreur, pas possible de faire un héritage dans un sens puis dans l'autre 
        - Pas d'héritage multiple : class G extends I, J, K // Erreur 

*/