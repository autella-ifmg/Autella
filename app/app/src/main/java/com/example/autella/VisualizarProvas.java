package com.example.autella;

import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.content.Intent;


import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.ArrayList;

public class VisualizarProvas extends AppCompatActivity {
    private ListView listaProvas;
    private ArrayList<Prova> provas;
    private ItemListaProvas adapter;

    private RequestQueue mQueue;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_visualizar_provas);
        listaProvas = (ListView) findViewById(R.id.listaProvas);

        Intent intencao = getIntent();
        carregaProvasLista();
    }

    private void carregaProvasLista() {
        System.out.println("Início da função");
        provas = new ArrayList<>();

        mQueue = Volley.newRequestQueue(this);
//        String urlDoRequest = "http://autella.com/api/require.php?metodo=1";
        String urlDoRequest = "http://10.0.2.2/autella.com/api/require.php?metodo=1";

        System.out.println("Inicializando request");
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, urlDoRequest, null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("provas");
                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject prova = jsonArray.getJSONObject(i);

                                String nomeDaProva = prova.getString("name");
                                int idDaProva = prova.getInt("id");
                                String dataDeLiberacao = prova.getString("release_date");
                                
                                dataDeLiberacao = dataDeLiberacao.replace("-", "/");
                                String[] s = dataDeLiberacao.split("/");
                                dataDeLiberacao = s[2] + "/" + s[1] + "/" + s[0];
                                //System.out.println(dataDeLiberacao);

                                provas.add(new Prova(nomeDaProva, idDaProva, dataDeLiberacao));

                                System.out.println("Prova " + nomeDaProva + " adicionada na lista.");
                            }
                            System.out.println("Criando adapter");
                            adapter = new ItemListaProvas(getApplicationContext(), provas);
                            System.out.println("Setando adapter");
                            listaProvas.setAdapter(adapter);

                            System.out.println("Setando On Item Click Listener");
                            System.out.println("Marcação Importante 1");
                            listaProvas.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                                @Override
                                public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                                    Intent troca = new Intent(VisualizarProvas.this, VisualizarGabarito.class);
                                    Prova temp = provas.get(position);
                                    troca.putExtra("nomeDaProva", temp.getNome());
                                    troca.putExtra("idDaProva", temp.getId());
                                    startActivityForResult(troca, 0);
                                }
                            });
                            System.out.println("Marcação Importante 2");
                        } catch (JSONException e) {
                            e.printStackTrace();
                            System.out.println("BugPoint 3");
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
        System.out.println("mQueue.add(request);");
        mQueue.add(request);
        System.out.println("Fim da função ");
    }
}
