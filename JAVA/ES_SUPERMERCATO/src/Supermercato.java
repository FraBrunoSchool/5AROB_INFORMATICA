import java.io.IOException;
import java.util.Vector;

public class Supermercato {
    private Vector <Prodotto> prodotti;
    private String nome;
    private String nomeArchivio;
    private CSVParser c;
    private String fileName;

    public Supermercato(String nome, String nomeArchivio, String fileName) throws IOException {
        this.nome=nome;
        this.nomeArchivio=nomeArchivio;
        prodotti= new Vector<Prodotto>();
        c = new CSVParser(fileName);
        prodotti.addAll(c.readCSV());
        this.fileName = fileName;
    }

    public void addProdotto(Prodotto prodotto){
        if(ricercaProdotto(prodotto.getCodiceProdotto())==null && ricercaProdotto(prodotto.getNomeProdotto())==null){
            prodotti.add(prodotto);
        }
    }

    public Prodotto ricercaProdotto(long codice){
        int cont = 0;
        while(cont<prodotti.size()){
            if(prodotti.get(cont).getCodiceProdotto()==codice){
                return prodotti.get(cont);
            }
            cont++;
        }
        return null; // se non esiste
    }

    public Prodotto ricercaProdotto(String nome){
        int cont = 0;
        while(cont<prodotti.size()){
            if(prodotti.get(cont).getNomeProdotto().equals(nome)){
                return prodotti.get(cont);
            }
            cont++;
        }
        return null; // se non esiste
    }

    public void deleteProdotto(long codice){
        for (int i = 0; i < prodotti.size(); i++) {
            Prodotto p = prodotti.get(i);
            if (p.getCodiceProdotto()==codice){
                prodotti.removeElementAt(i);
            }
        }
    }

    public void updateProdotto(long codice, Prodotto prodotto){
        for (int i = 0; i < prodotti.size(); i++) {
            Prodotto p = prodotti.get(i);
            if (p.getCodiceProdotto()==codice){
                prodotti.set(i, prodotto);
            }
        }
    }

    public Vector<Prodotto> ricercaValoreReparto(String reparto){
        Vector <Prodotto> prodottiRep = new Vector<Prodotto>();
        int cont = 0;
        while(cont<prodotti.size()){
            if((String.valueOf(prodotti.get(cont).getReparto()).toUpperCase()).equals(reparto.toUpperCase())){
                prodottiRep.add(prodotti.get(cont));
            }
            cont++;
        }
        return prodottiRep;
    }

    public String telefonoResponsabile(String reparto){
        int cont = 0;
        while(cont<prodotti.size()){
            if((String.valueOf(prodotti.get(cont).getReparto()).toUpperCase()).equals(reparto.toUpperCase())){
                return "Responsabile: " + prodotti.get(cont).getResponsabile() + " Numero: " + prodotti.get(cont).getTelefono();
            }
            cont++;
        }
        return "Nessun Responsabile Trovato";
    }

    public void salvaSupermercatoCSV(){
        Vector <String> save = new Vector<String>();
        for (Prodotto p: prodotti) {
            save.add(p.toStringSave());
        }
        c.writeCSV(save, fileName);
    }
    @Override
    public String toString() {
        String print = "";
        for (Prodotto p : prodotti) print += p.toStringSave() + "\n";
        return "Supermercato{" +
                "prodotti=" + print +
                ", nome='" + nome + '\'' +
                ", nomeArchivio='" + nomeArchivio + '\'' +
                '}';
    }
}