import java.time.LocalDate;
import java.util.GregorianCalendar;

public class Prodotto {
    private String produttore="";
    private Enum reparto;
    private Enum categoria;
    private String scaffale= "";
    private String nomeProdotto;
    private double quantita;
    private long codiceProdotto;
    private Enum unitaMisura;
    private float prezzo;
    private String taglia="";
    private float sconto=0;
    private String responsabile;
    private String telefono;
    private java.time.LocalDate scadenza;

    public Prodotto(String produttore, Enum reparto, Enum categoria,
                    String scaffale, String nomeProdotto, double quantita,
                    long codiceProdotto, Enum unitaMisura, float prezzo, String taglia,
                    float sconto, String responsabile, String telefono,
                    java.time.LocalDate scadenza) {
        this.produttore = produttore;
        this.reparto = reparto;
        this.categoria = categoria;
        this.scaffale = scaffale;
        this.nomeProdotto = nomeProdotto;
        this.quantita = quantita;
        this.codiceProdotto = codiceProdotto;
        this.unitaMisura = unitaMisura;
        this.prezzo = prezzo;
        this.taglia = taglia;
        this.sconto = sconto;
        this.responsabile = responsabile;
        this.telefono = telefono;
        this.scadenza = scadenza;
    }

    public String getProduttore() {
        return produttore;
    }

    public Enum getReparto() {
        return reparto;
    }

    public Enum getCategoria() {
        return categoria;
    }

    public String getScaffale() {
        return scaffale;
    }

    public String getNomeProdotto() {
        return nomeProdotto;
    }

    public double getQuantita() {
        return quantita;
    }

    public long getCodiceProdotto() {
        return codiceProdotto;
    }

    public Enum getUnitaMisura() {
        return unitaMisura;
    }

    public float getPrezzo() {
        return prezzo;
    }

    public String getTaglia() {
        return taglia;
    }

    public float getSconto() {
        return sconto;
    }

    public String getResponsabile() {
        return responsabile;
    }

    public String getTelefono() {
        return telefono;
    }

    public void setProduttore(String produttore) {
        this.produttore = produttore;
    }

    public void setReparto(Enum reparto) {
        this.reparto = reparto;
    }

    public void setCategoria(Enum categoria) {
        this.categoria = categoria;
    }

    public void setScaffale(String scaffale) {
        this.scaffale = scaffale;
    }

    public void setNomeProdotto(String nomeProdotto) {
        this.nomeProdotto = nomeProdotto;
    }

    public void setQuantita(double quantita) {
        this.quantita = quantita;
    }

    public void setCodiceProdotto(long codiceProdotto) {
        this.codiceProdotto = codiceProdotto;
    }

    public void setUnitaMisura(Enum unitaMisura) {
        this.unitaMisura = unitaMisura;
    }

    public void setPrezzo(float prezzo) {
        this.prezzo = prezzo;
    }

    public void setTaglia(String taglia) {
        this.taglia = taglia;
    }

    public void setSconto(float sconto) {
        this.sconto = sconto;
    }

    public void setResponsabile(String responsabile) {
        this.responsabile = responsabile;
    }

    public void setTelefono(String telefono) {
        this.telefono = telefono;
    }

    public void setScadenza(LocalDate scadenza) {
        this.scadenza = scadenza;
    }

    public String toStringSave() {
        char carattere = ',';
        return  produttore + carattere +
                reparto + carattere +
                categoria + carattere +
                scaffale + carattere +
                nomeProdotto + carattere +
                quantita + carattere +
                codiceProdotto + carattere +
                unitaMisura + carattere +
                prezzo + carattere +
                taglia + carattere +
                sconto + carattere +
                responsabile + carattere +
                telefono + carattere +
                scadenza + carattere;
    }
}