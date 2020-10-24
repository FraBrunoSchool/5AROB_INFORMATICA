import java.io.*;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.util.GregorianCalendar;
import java.util.Vector;

public class CSVParser {
    private String fileName;

    public CSVParser(String fileName){
        this.fileName = fileName;
    }

    public Vector<Prodotto> readCSV() throws IOException {
        String row;
        int k = 0;
        Vector<Prodotto> prodotti = new Vector<Prodotto>();

        BufferedReader csvReader = null;

        try {
            // prova apertura file
            csvReader = new BufferedReader(new FileReader(this.fileName));
            while ((row = csvReader.readLine()) != null) {
                String[] data = row.split(",");
                String[] scadenza = data[13].split("-");
                prodotti.add(new Prodotto(data[0],
                        Reparto.valueOf(data[1].toUpperCase()),
                        Categoria.valueOf(data[2].toUpperCase()),
                        data[3],
                        data[4],
                        Double.parseDouble(data[5]),
                        Long.parseLong(data[6]),
                        UnitaMisura.valueOf(data[7].toUpperCase()),
                        Float.parseFloat(data[8]),
                        data[9],
                        Float.parseFloat(data[10]),
                        data[11],
                        data[12],
                        LocalDate.of(Integer.parseInt(scadenza[0]), Integer.parseInt(scadenza[1]), Integer.parseInt(scadenza[2]))
                ));
            }
            System.out.println("Operazione di salvataggio eseguita con successo.");
        } catch (IOException e){ // IOException -> classe madre della classe FileNotFoundException
            System.out.println("File non trovato\n");
            e.printStackTrace();
        } finally {
            try {
                if (csvReader != null) csvReader.close();
            } catch (IOException ex) {
                ex.printStackTrace();
            }
        }
        return prodotti;
    }

    public void writeCSV(Vector <String> values, String fileName){
        File file = null;
        FileWriter fileWriter = null;
        BufferedWriter writer = null;

        try {
            file = new File(fileName);
            fileWriter = new FileWriter(file);
            if (!file.exists()) file.createNewFile();
            writer = new BufferedWriter(fileWriter);
            for (String value : values){
                try {
                    writer.write(value+"\n");
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            System.out.println("Operazione di caricamento eseguita con successo.");
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            if (writer != null) {
                try {
                    writer.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            if (fileWriter != null) {
                try {
                    fileWriter.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }

    }

}