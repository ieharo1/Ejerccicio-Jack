/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ejerccicio.jack;

import java.util.Scanner;

/**
 *
 * @author 
 */
public class EjerccicioJack {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        int numero;
        boolean aux=true;
        Scanner sc= new Scanner(System.in);
        while(aux){
        try{
            System.out.println("Ingrese el valor inicial de la serie");
            numero=sc.nextInt();
            if(numero > 99||numero <0){
                System.out.print("Error: Debe ingresar un numero entre 0 y 99");
                numero=sc.nextInt();
            }       
            aux=false;
        }
        catch(Exception e){
            System.out.println("Error: ");
            String aux2= sc.nextLine();
        }
        }
           
    }
     public static void Suma_Numero (int numero){
        String transformar;
        transformar=String.valueOf(numero);
        
    }
}
