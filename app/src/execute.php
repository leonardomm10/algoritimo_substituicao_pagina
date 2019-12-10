<?php

class Execute
{

  public function Fifo($string, $frames)
  {
    $array  = array();                                                  //Array pricipal                  
    $first = 0;                                                         //Difine a primeira posição do array (variavel de contagem)
    for ($x = 0; $x < sizeof($string); $x++) {                          //Lê cada cada valor da string
      echo "<tr>";
      if (!in_array($string[$x], $array)) {                             //Verifica se valor nao esta no array pricipal
        if (sizeof($array) >= $frames) {                                //Verifica se array pricipal esta cheio
          $array[$first] = $string[$x];                                 //Substitui o valor antigo pelo novo valor
          if ($first >= $frames - 1) {                                  //Verifica se variavel de contagem estourou o limite dos frames
            $first = 0;                                                 //Se estourar o limite ele zera o contador
          } else {                                                      //Se nao estourar
            $first++;                                                   //Incrementa o contador para pegar a proxima posição do array
          }
        } else {                                                        //Se valor nao esta no array
          array_push($array, $string[$x]);                              //Adiciona valor no array
        }
        for ($y = 0; $y < $frames; $y++) {                              //Le o array baseado na quantidade de frames
          echo "<td>" . $array[$y] . "</td>";                           //Exibe os valores na tabela
        }
      } else {                                                          //Se o valor ja existir no array (duplicado)
        for ($y = 0; $y < $frames; $y++) {                              //Le o array baseado na quantidade de frames
          echo "<td> </td>";                                            //Exibe em branco na tabela
        }
      }
      echo "</tr>";
    }
  }

  public function Lru($string, $frames)
  {
    $array = array();                                                   //Array pricipal
    $arrayc = array();                                                  //Array de trocas
    for ($i = 0; $i < sizeof($string); $i++) {                          //Lê cada cada valor da string
      echo "<tr>";
      if (!in_array($string[$i], $array)) {                             //Verifica se valor nao esta no array pricipal
        if (sizeof($array) >= $frames) {                                //Verifica se array pricipal esta cheio
          $value = current($arrayc);                                    //Pega o valor da primeira posição do array de troca
          $key = array_search($value, $array);                          //Procura a posição do valor do array de troca no array pricipal
          $array[$key] = $string[$i];                                   //Substitui o valor antigo pelo novo valor no array pricipal
          array_push($arrayc, $string[$i]);                             //Adiciona o valor no array de troca
          array_shift($arrayc);                                         //Remove a primeira posição do array de troca
        } else {                                                        //Se valor nao esta no array
          array_push($array, $string[$i]);                              //Adiciona valor no array pricipal
          array_push($arrayc, $string[$i]);                             //Adiciona valor no array de troca
        }
        for ($y = 0; $y < $frames; $y++) {                              //Le o array baseado na quantidade de frames
          echo "<td>" . $array[$y] . "</td>";                           //Exibe os valores na tabela
        }
      } else {                                                          //Se o valor ja existir no array (duplicado)
        if (sizeof($array) >= $frames) {                                //Verifica se array pricipal esta cheio
          $var = array_search($string[$i], $arrayc);                    //Pega a posição do valor no array de troca
          unset($arrayc[$var]);                                         //Remove o valor encontrado do array de troca
          array_push($arrayc, $string[$i]);                             //Adiciona o valor duplicado novamente no final do array
        }
        for ($y = 0; $y < $frames; $y++) {                              //Le o array baseado na quantidade de frames
          echo "<td> </td>";                                            //Exibe em branco na tabela
        }
      }
      echo "</tr>";
    }
  }

  public function Lifo($string, $frames)
  {
    $array  = array();                                                  //Array pricipal
    for ($x = 0; $x < sizeof($string); $x++) {                          //Lê cada cada valor da string
      echo "<tr>";
      if (!in_array($string[$x], $array)) {                             //Verifica se valor nao esta no array pricipal
        if (sizeof($array) >= $frames) {                                //Verifica se array pricipal esta cheio
          $last = $string[$x - 1];                                      //Pega o ultimo valor inserido no array (posição anterior da string (x-1))
          $key = array_search($last, $array);                           //Procura o procurar esse valor no array
          $array[$key] = $string[$x];                                   //Coloca o valor na posicao no valor anterior
        } else {                                                        //Se valor nao esta no array
          array_push($array, $string[$x]);                              //Adiciona valor no array
        }
        for ($y = 0; $y < $frames; $y++) {                              //Le o array baseado na quantidade de frames
          echo "<td>" . $array[$y] . "</td>";                           //Exibe os valores na tabela
        }
      } else {
        for ($y = 0; $y < $frames; $y++) {                              //Le o array baseado na quantidade de frames
          echo "<td> </td>";                                            //Exibe em branco na tabela
        }
      }
      echo "</tr>";
    }
  }

  public function Otimo($string, $frames)
  { 
    $array  = array();                                                  //Array pricipal
    for ($x = 0; $x < sizeof($string); $x++) {                          //Lê cada cada valor da string
      echo "<tr>";
      if (!in_array($string[$x], $array)) {                             //Verifica se valor nao esta no array pricipal
        if (sizeof($array) >= $frames) {                                //Verifica se array pricipal esta cheio
          $maior = 0;                                                   //Zera essas 3 variáveis para serem utilizadas posteriormente
          $indice = 0;
          $talvez_maior = 0;
          for ($y = 0; $y < sizeof($array); $y++) {                     //For para percorrer o array principal
            $encontrou = 0;                                             //Zera varíavel para ser utilizada mais tarde
            for ($z = $x; $z < sizeof($string); $z++) {                 //For para percorrer a string que foi digitado, porém vai começar a partir do 
                                                                        //último elemento jogado para o array principal
              if($array[$y]==$string[$z]){                              //Tenta achar um valor da string que seja igual a um do array principal            
                $encontrou = 1;                                         //Joga 1 na variável encontrou pra não passar no outro if mais abaixo
                $talvez_maior = $z;                                     
                if($talvez_maior > $maior)                              //Faz a comparação para ver qual valor encontrado está mais longe
                {
                  $maior = $talvez_maior;
                  $indice = $y;                                         //Salva a posição do array principal que terá que ser trocada
                }
                $z = sizeof($string);
              }
            }
            if($encontrou == 0){                                        //Caso não não seja encontrado nenhum valor igual na string
              $maior = 0;                                               //marca o "maior" como 0
              $troca = $array[$y];                                      //e joga o valor do array principal que nãoe xiste na string para a troca
              break;                                                    //Faz o break e cai fora dos For
            }
          }
          if($maior>0){
            $indice_do_array = array_search($array[$indice], $array);   //Caso todos os valores do array ainda estejam presentes na string
            $array[$indice_do_array] = $string[$x];                     //será trocado aquele que estiver localizado mais longe
          }
          else{
            $indice_do_array = array_search($troca, $array);            //Caso um dos valores do array não existam mais na string, ele será trocado
            $array[$indice_do_array] = $string[$x];
          }
        } else {                                                        //Se valor nao esta no array
          array_push($array, $string[$x]);                              //Adiciona valor no array
        }
        for ($y = 0; $y < $frames; $y++) {                              //Le o array baseado na quantidade de frames
          echo "<td>" . $array[$y] . "</td>";                           //Exibe os valores na tabela
        }
      } else {                                                          //Se o valor ja existir no array (duplicado)
        for ($y = 0; $y < $frames; $y++) {                              //Le o array baseado na quantidade de frames
          echo "<td> </td>";                                            //Exibe em branco na tabela
        }
      }
      echo "</tr>";
    }
  }
}
