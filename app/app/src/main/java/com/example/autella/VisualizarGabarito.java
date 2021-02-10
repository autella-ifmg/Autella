package com.example.autella;

import android.content.Intent;
import android.os.Bundle;
import android.os.PersistableBundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class VisualizarGabarito extends AppCompatActivity {
    private ListView listaGabarito;
    private TextView nomeDaProvaTxt;
    private int idDaProva;

    private RequestQueue mQueue;

    private ArrayList<Questao> questoes;
    private ItemListaQuestoes adapter;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_visualizar_gabarito);
        listaGabarito = (ListView) findViewById(R.id.listaGabarito);
        nomeDaProvaTxt = (TextView) findViewById(R.id.nomeDaProva);


        Intent intencao = getIntent();
        nomeDaProvaTxt.setText(intencao.getStringExtra("nomeDaProva"));
        idDaProva = intencao.getIntExtra("idDaProva", -1);
        carregaQuestoesLista();
    }


    private void carregaQuestoesLista(){
        questoes = new ArrayList<>();

        mQueue = Volley.newRequestQueue(this);
//        String urlDoRequest = "http://autella.com/api/require.php?metodo=2";
        String urlDoRequest = "http://10.0.2.2/autella.com/api/require.php?metodo=2&idDaProva=" + this.idDaProva ;
        System.out.println(urlDoRequest);

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, urlDoRequest, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("gabarito");
                            for(int i = 0; i < jsonArray.length(); i++){
                                JSONObject prova = jsonArray.getJSONObject(i);
                                String alternativaCorreta = prova.getString("alternativaCorreta");
                                questoes.add(new Questao(alternativaCorreta));
                            }
                            adapter = new ItemListaQuestoes(getApplicationContext(), questoes);
                            listaGabarito.setAdapter(adapter);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
        mQueue.add(request);
    }
}
