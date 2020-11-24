/***
 * author:Badoino Matteo
 * date:05/02/2020
 * legge in input da tastiera e lo converte nei tipi primitivi int, float e double gestendo le eccezioni
 * */


import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
public class Tastiera {
    /***
     * lettura input da tastiera
     */
    private static BufferedReader tastiera = new BufferedReader(new InputStreamReader(System.in));

    /***
     * conversione input da tastiera nel tipo primitivo int
     */
    public static int leggiIntero(String mess, int min, int max) throws ValoreNonRange {
        int numInt = 0;
        boolean errore;
        do {
            errore = false;
            System.out.println(mess);
            try {
                numInt = Integer.parseInt(tastiera.readLine());
                if (numInt < min || numInt > max) throw new ValoreNonRange("inserire un numero tra " + min + "e" + max);
                errore = true;
            } catch (NumberFormatException e) {
                System.out.println("numero non valido");
            } catch (IOException e) {
                System.out.println("errore nell'input");
            }
        }while (!errore);
        return numInt;
    }
    /***
     * conversione input da tastiera nel tipo primitivo float
     */
    public static float leggiFloat(String mess, float min, float max) throws ValoreNonRange {
        float numFloat = 0;
        boolean errore;
        do {
            errore = false;
            System.out.println(mess);
            try {
                numFloat = Float.parseFloat(tastiera.readLine());
                if (numFloat < min || numFloat > max) throw new ValoreNonRange("inserire un numero tra " + min + "e" + max);
                errore = true;
            } catch (NumberFormatException e) {
                System.out.println("numero non valido");
            } catch (IOException e) {
                System.out.println("errore nell'input");
            }
        }while (!errore);
        return numFloat;
    }
    /***
     * conversione input da tastiera nel tipo primitivo double
     */
    public static double leggiDouble(String mess, double min, double max) throws ValoreNonRange {
        double num = 0;
        boolean errore;
        do {
            errore = false;
            System.out.println(mess);
            try {
                num = Double.parseDouble(tastiera.readLine());
                if (num < min || num > max) throw new ValoreNonRange("inserire un numero tra " + min + "e" + max);
                errore = true;
            } catch (NumberFormatException e) {
                System.out.println("numero non valido");
            } catch (IOException e) {
                System.out.println("errore nell'input");
            }
        }while (!errore);
        return num;
    }

    public static String readString(String mess){
        String app = null;

        boolean errore;
        do {
            errore = false;
            System.out.println(mess);
            try {
                app = tastiera.readLine();
                errore = true;
            } catch (IOException e) {
                System.out.printf("errore di IO");
            }
        }while (!errore);

        return app;
    }
    
}
